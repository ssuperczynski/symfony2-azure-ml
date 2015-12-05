<?php

namespace MainBundle\Service;

use Doctrine\ORM\EntityManager;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class WineSaveService
 * @package MainBundle\Service;
 */
class WineSaveService extends SendToMLService implements ConsumerInterface
{
    const DEFAULT_URL = 'https://azurewines.firebaseio.com/';
    const DEFAULT_TOKEN = 'jhpmmtPidAHoxswYP2QWO213B0Qx2jUNZFeBivsQ';
    const DEFAULT_PATH = '/wine';
    const MS_URL = 'https://ussouthcentral.services.azureml.net/workspaces/8cc62d04a53c415cb85e331b37682a91/services/df8e2afa0b6844f598a8f80acfb4f626/execute?api-version=2.0&details=true';
    const MS_TOKEN = 'sOgsy96HZKYCYoMLa7s2CUdZ3zRizErHT9Rh84HQMV7mxm3X5VAf6GtwHpzViTXbL4iNCE9ecAEymaDvHbFI9w==';

    /**
     * @param EntityManager $em
     */
    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param AMQPMessage $msg
     * @return void
     */
    public function execute(AMQPMessage $msg)
    {
        $data = json_decode($msg->body);

        $body = <<<JSON
{
  "Inputs": {
    "input1": {
      "ColumnNames": [
        "fixed acidity",
        "volatile acidity",
        "citric acid",
        "residual sugar",
        "chlorides",
        "free sulfur dioxide",
        "total sulfur dioxide",
        "density",
        "pH",
        "sulphates",
        "alcohol",
        "quality"
      ],
      "Values": [
        [
            "$data->fixedAcidity",
            "$data->volatileAcidity",
            "$data->citricAcidity",
            "$data->residualSugar",
            "$data->chlorides",
            "$data->freeSugar",
            "$data->totalSugar",
            "$data->density",
            "$data->pH",
            "$data->sulphates",
            "$data->alcohol",
            "$data->quality"
        ]
      ]
    }
  },
  "GlobalParameters": {}
}
JSON;

        $response = $this->send(self::MS_URL, $body, self::MS_TOKEN);
        $data = json_decode($response);
        $array = array_combine($data->Results->output1->value->ColumnNames, $data->Results->output1->value->Values[0]);
        $formattedArray = [
            'fixedAcidity' => $array['fixed acidity'],
            'volatileAcidity' => $array['volatile acidity'],
            'citricAcidity' => $array['citric acid'],
            'residualSugar' => $array['residual sugar'],
            'chlorides' => $array['chlorides'],
            'freeSugar' => $array['free sulfur dioxide'],
            'totalSugar' => $array['total sulfur dioxide'],
            'density' => $array['density'],
            'pH' => $array['pH'],
            'sulphates' => $array['sulphates'],
            'alcohol' => $array['alcohol'],
            'quality' => $array['quality'],
            'result' => $array['Scored Labels'],
        ];
        $this->sendToFirebase($formattedArray, self::DEFAULT_URL, self::DEFAULT_TOKEN, self::DEFAULT_PATH);
    }
}
