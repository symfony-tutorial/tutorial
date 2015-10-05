<?php

namespace AppBundle\Command;

use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCrudCommand as DoctrineCrudCommand;

class GenerateDoctrineCrudCommand extends DoctrineCrudCommand
{

    protected function configure()
    {
        parent::configure();
        $this->setName('app:generate:crud');
    }

    protected function createGenerator($bundle = null)
    {
        $filesystem = $this->getContainer()->get('filesystem');
        return new \AppBundle\Generator\DoctrineCrudGenerator($filesystem);
    }

}
