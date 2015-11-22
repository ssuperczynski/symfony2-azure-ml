<?php

namespace MainBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class QueueMushroomCommand  extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('queue:mushroom')
            ->setDescription('Queue mushrooms');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('mushroom_queue')->process(1, "2015-11-11 23:23:23", 1, 1);
        echo 'Queued'.PHP_EOL;
    }
}
