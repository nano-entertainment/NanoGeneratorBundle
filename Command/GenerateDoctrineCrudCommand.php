<?php

namespace Nano\Bundle\GeneratorBundle\Command;
 
use Sensio\Bundle\GeneratorBundle\Command\GenerateDoctrineCrudCommand as SensioGenerateDoctrineCommand;
use Nano\Bundle\GeneratorBundle\Generator\DoctrineCrudGenerator;

/**
 * Description of GenerateDoctrineCrudCommand
 *
 * @author Lasse Nielsen <lasse.nielsen@nano-entertainment.de>
 */
class GenerateDoctrineCrudCommand extends SensioGenerateDoctrineCommand {
  
  protected $generator;
 
    protected function configure()
    {
        parent::configure();
 
        $this->setName('nano:generate:crud');
        $this->setDescription('Generate Crud and Layout');
    }
    
    protected function getGenerator()
    {
        if (null === $this->generator) {
            $this->generator = new DoctrineCrudGenerator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/skeleton/crud');
        }

        return $this->generator;
    }
}