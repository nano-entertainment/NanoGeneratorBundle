<?php
namespace Nano\Bundle\GeneratorBundle\Command;

use Sensio\Bundle\GeneratorBundle\Command\GenerateBundleCommand as SensioGenerateBundleCommand;
use Nano\Bundle\GeneratorBundle\Generator\BundleGenerator;

/**
 * Generates bundles
 *
 * @author Lasse Nielsen <lasse.nielsen@nano-entertainment.de>
 */
class GenerateBundleCommand extends SensioGenerateBundleCommand
{
    protected $generator;

    protected function configure()
    {
        parent::configure();

        $this->setName('nano:generate:bundle');
        $this->setDescription('Generate Bundle');

    }
    
    

    protected function getGenerator()
    {
        if (null === $this->generator) {
          $this->generator = new BundleGenerator($this->getContainer()->get('filesystem'), __DIR__.'/../Resources/skeleton/bundle');
        }

        return $this->generator;
    }

    public function setGenerator(BundleGenerator $generator)
    {
        $this->generator = $generator;
    }
}
