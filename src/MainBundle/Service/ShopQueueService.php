<?php

namespace MainBundle\Service;

use OldSound\RabbitMqBundle\RabbitMq\Producer;

/**
 * Class ShopQueueService
 * @package MainBundle\Service;
 */
class ShopQueueService
{
    /** @var Producer $producer */
    private $producer;

    /**
     * @param Producer $producer
     */
    public function __construct(Producer $producer)
    {
        $this->producer = $producer;
    }


    /**
     * @param $data
     */
    public function process($data)
    {
        $this->producer->publish(json_encode($data));
    }
}