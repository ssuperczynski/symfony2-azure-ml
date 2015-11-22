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
 * Class MushroomSaveService
 * @package MainBundle\Service;
 */
class MushroomSaveService implements ConsumerInterface
{
    const DEFAULT_URL = 'https://azureml.firebaseio.com/';
    const DEFAULT_TOKEN = 'p8JsTwvf6W2QxEpNSecYI69Viw1zy8w1Gz7Hr31Y';
    const DEFAULT_PATH = '/mushrooms';

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
        $mock = <<<JSON
{
  "Inputs": {
    "input1": {
      "ColumnNames": [
        "edible",
        "cap-shape",
        "cap-color",
        "odor",
        "gill-color",
        "stalk-color"
      ],
      "Values": [
        [
          "edible",
          "bell",
          "red",
          "1",
          "red",
          "red"
        ]
      ]
    }
  },
  "GlobalParameters": {}
}
JSON;
        $url = 'https://ussouthcentral.services.azureml.net/workspaces/8cc62d04a53c415cb85e331b37682a91/services/e2a7b6358e30410bbeb9a03db413ba6b/execute?api-version=2.0&details=true';
        try {
            $headers = [
                'Authorization' => 'Bearer jV53kXuYi345dJ726vKeq2ixQOPrq3+uINr5jOOeEecJqh5CuQv1zyRXeIP7/k1NPWPZEQj8aFCnjsz6Yh08ug==',
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

    private function sendToFirebase($content)
    {
        $firebase = new FirebaseLib(self::DEFAULT_URL, self::DEFAULT_TOKEN);
        $data = json_decode($content);
        $array = array_combine($data->Results->output1->value->ColumnNames, $data->Results->output1->value->Values[0]);
        $formattedArray = [
            'result' => $array['Scored Labels'],
            'percent' => $array['Scored Probabilities'],
            'capColor' => $array['cap-color'],
            'capShape' => $array['cap-shape'],
            'edible' => $array['edible'],
            'gillColor' => $array['gill-color'],
            'stalkColor' => $array['stalk-color'],
            'odor' => strtolower($array['odor']),
        ];

        $firebase->push(self::DEFAULT_PATH, $formattedArray);
    }
}
