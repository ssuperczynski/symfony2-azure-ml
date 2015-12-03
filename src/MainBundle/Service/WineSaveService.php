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
    const DEFAULT_URL = 'https://azureml.firebaseio.com/';
    const DEFAULT_TOKEN = 'p8JsTwvf6W2QxEpNSecYI69Viw1zy8w1Gz7Hr31Y';
    const DEFAULT_PATH = '/wine';
    const MS_URL = 'https://ussouthcentral.services.azureml.net/workspaces/8cc62d04a53c415cb85e331b37682a91/services/e2a7b6358e30410bbeb9a03db413ba6b/execute?api-version=2.0&details=true';
    const MS_TOKEN = 'jV53kXuYi345dJ726vKeq2ixQOPrq3+uINr5jOOeEecJqh5CuQv1zyRXeIP7/k1NPWPZEQj8aFCnjsz6Yh08ug==';

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
        "edible",
        "cap-shape",
        "cap-color",
        "odor",
        "gill-color",
        "stalk-color"
      ],
      "Values": [
        [
            "$data->edible",
            "$data->capShape",
            "$data->capColor",
            "$data->odor",
            "$data->gillColor",
            "$data->stalkColor",
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
            'result' => $array['Scored Labels'],
            'percent' => $array['Scored Probabilities'],
            'capColor' => $array['cap-color'],
            'capShape' => $array['cap-shape'],
            'edible' => $array['edible'],
            'gillColor' => $array['gill-color'],
            'stalkColor' => $array['stalk-color'],
            'odor' => strtolower($array['odor']),
        ];
        $this->sendToFirebase($formattedArray, self::DEFAULT_URL, self::DEFAULT_TOKEN, self::DEFAULT_PATH);
    }
}
