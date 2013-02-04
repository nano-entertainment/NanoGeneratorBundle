<?php

namespace Nano\Bundle\GeneratorBundle\Tests\Command;

use Sensio\Bundle\GeneratorBundle\Tests\Command\GenerateBundleCommandTest as SensioGenerateBundleCommandTest;
use Nano\Bundle\GeneratorBundle\Command\GenerateBundleCommand;

class GenerateBundleCommandTest extends SensioGenerateBundleCommandTest
{
    public function getInteractiveCommandData()
    {
        $tmp = sys_get_temp_dir();

        return array(
            array(array('--dir' => $tmp), "Foo/BarBundle\n", array('Foo\BarBundle', 'FooBarBundle', $tmp.'/', 'annotation', false)),
            array(array('--dir' => $tmp), "Foo/BarBundle\nBarBundle\nfoo\nyml\nn", array('Foo\BarBundle', 'BarBundle', 'foo/', 'yml', false)),
            array(array('--dir' => $tmp, '--format' => 'yml', '--bundle-name' => 'BarBundle', '--structure' => true), "Foo/BarBundle\n", array('Foo\BarBundle', 'BarBundle', $tmp.'/', 'yml', true)),
        );
    }

    public function getNonInteractiveCommandData()
    {
        $tmp = sys_get_temp_dir();

        return array(
            array(array('--dir' => $tmp, '--namespace' => 'Foo/BarBundle'), array('Foo\BarBundle', 'FooBarBundle', $tmp.'/', 'annotation', false)),
            array(array('--dir' => $tmp, '--namespace' => 'Foo/BarBundle', '--format' => 'yml', '--bundle-name' => 'BarBundle', '--structure' => true), array('Foo\BarBundle', 'BarBundle', $tmp.'/', 'yml', true)),
        );
    }

    protected function getCommand($generator, $input)
    {
        $command = $this
            ->getMockBuilder('Nano\Bundle\GeneratorBundle\Command\GenerateBundleCommand')
            ->setMethods(array('checkAutoloader', 'updateKernel', 'updateRouting'))
            ->getMock()
        ;

        $command->setContainer($this->getContainer());
        $command->setHelperSet($this->getHelperSet($input));
        $command->setGenerator($generator);

        return $command;
    }

    protected function getGenerator()
    {
        // get a noop generator
        return $this
            ->getMockBuilder('Nano\Bundle\GeneratorBundle\Generator\BundleGenerator')
            ->disableOriginalConstructor()
            ->setMethods(array('generate'))
            ->getMock()
        ;
    }
}
