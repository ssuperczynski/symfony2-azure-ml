<?php

namespace MainBundle\Service;

use Doctrine\ORM\EntityManager;
use Firebase\FirebaseLib;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class ShopSaveService
 * @package MainBundle\Service;
 */
class ShopSaveService implements ConsumerInterface
{
    const DEFAULT_URL = 'https://amber-heat-9116.firebaseio.com/';
    const DEFAULT_TOKEN = 'Kxz1Awrd53RRCNMaxQjhjOIhNTbcY0ySzbVsjGjo';
    const DEFAULT_PATH = '/shops';

    /**
     * @param EntityManager $em
     */
    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param AMQPMessage $msg
     */
    public function execute(AMQPMessage $msg)
    {
        $content = json_decode($msg->body);
        $data = $content->payload;
        $hasStreetEntrance = (true === $data->hasStreetEntrance) ? "true" : "false";
        $hasBusStop = (true === $data->hasBusStop) ? "true" : "false";
        $hasGasStation = (true === $data->hasGasStation) ? "true" : "false";
        $distanceAnotherShop100m = (true === $data->distanceAnotherShop100m) ? "true" : "false";
        $distanceAnotherShop500m = (true === $data->distanceAnotherShop500m) ? "true" : "false";
        $hasParking = (true === $data->hasParking) ? "true" : "false";
        $mock = <<<JSON
{
  "Inputs": {
    "input1": {
      "ColumnNames": [
        "city",
        "street",
        "street_nr",
        "city_population",
        "has_street_entrance",
        "has_bus_stop",
        "price_sq",
        "has_gas_station",
        "distance_another_shop_100m",
        "distance_another_shop_500m",
        "has_parking",
        "income_USD"
      ],
      "Values": [
        [
        "$data->city",
        "$data->street",
        "$data->streetNr",
        "$data->cityPopulation",
        "$hasStreetEntrance",
        "$hasBusStop",
        "$data->priceSq",
        "$hasGasStation",
        "$distanceAnotherShop100m",
        "$distanceAnotherShop500m",
        "$hasParking",
        "$data->incomeUSD"
        ]
      ]
    }
  },
  "GlobalParameters": {}
}
JSON;

        $url = 'https://ussouthcentral.services.azureml.net/workspaces/8cc62d04a53c415cb85e331b37682a91/services/455995f6e21b45d995fce2b747ed087f/execute?api-version=2.0&details=true';
        try {
            $headers = [
                'Authorization' => 'Bearer dq04YIxs5EdN2poYH2cvxkqzxXiIN5NGqbCmhZuJFZtCcTLwwm90kKkR9BeqtKS70qXJIyj6awNVzFjZbPwdlw==',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ];

            $client = new Client();
            $response = $client->post($url, [
                'body' => $mock,
                'headers' => $headers,
            ]);

            $this->sendToFirebase($response->getBody()->getContents());
        } catch (ClientException $e) {
            throw $e;
        } catch (ServerException $e) {
            throw $e;
        }
    }

    /**
     * @param $content
     */
    private function sendToFirebase($content)
    {
        $firebase = new FirebaseLib(self::DEFAULT_URL, self::DEFAULT_TOKEN);
        $data = json_decode($content);
        $array = array_combine($data->Results->output1->value->ColumnNames, $data->Results->output1->value->Values[0]);

        $formattedArray = [
            "city" => $array['city'],
            "street" => $array['street'],
            "streetRr" => $array['street_nr'],
            "cityPopulation" => $array['city_population'],
            "hasStreetEntrance" => strtolower($array['has_street_entrance']),
            "hasBusStop" => strtolower($array['has_bus_stop']),
            "priceSq" => strtolower($array['price_sq']),
            "hasGasStation" => strtolower($array['has_gas_station']),
            "distanceAnotherShop100m" => strtolower($array['distance_another_shop_100m']),
            "distanceAnotherShop500m" => strtolower($array['distance_another_shop_500m']),
            "hasParking" => strtolower($array['has_parking']),
            "incomeUSD" => $array['income_USD'],
            "result" => (int) $array['Scored Labels'],
        ];

        $firebase->push(self::DEFAULT_PATH, $formattedArray);
    }
}
