<?php

namespace MainBundle\Service;

use Doctrine\ORM\EntityManager;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

/**
 * Class MushroomSaveService
 * @package MainBundle\Service;
 */
class MushroomSaveService implements ConsumerInterface
{
    /**
     * @param EntityManager $em
     */
    function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function execute(AMQPMessage $msg)
    {
        echo 'Consumed!'.PHP_EOL;
    }
}