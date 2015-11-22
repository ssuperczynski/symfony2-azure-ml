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
     * @param \stdClass $content
     */
    public function process($content)
    {
        $this->producer->publish(json_encode($content->payload));
    }
}