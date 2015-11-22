<?php

namespace MainBundle\Service;

use OldSound\RabbitMqBundle\RabbitMq\Producer;

/**
 * Class MushroomQueueService
 * @package MainBundle\Service;
 */
class MushroomQueueService
{
    /** @var  Producer $producer */
    private $producer;

    /**
     * @param Producer $producer
     */
    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }

    /**
     * @param int $userId
     * @param string $time
     * @param int $range
     * @param int $amount
     */
    public function process($userId, $time, $range, $amount)
    {
        $data = [
            'user' => 1,
            'time' => (new \DateTime())->format('Y-m-d H:i:s'),
            'range' => 2,
            'amount' => 222
        ];
        $i = 10;
        while($i > 1) {
            $this->producer->publish(json_encode($data));
            $i--;
        }
    }
}