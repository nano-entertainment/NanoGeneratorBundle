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
            array(array('--dir' => $tmp), "Foo/BarABundle\n", array('Foo\BarBundle', 'FooBarBundle', $tmp.'/', 'annotation', false)),
            array(array('--dir' => $tmp), "Foo/BarBBundle\nBarBBundle\nfoo\nyml\nn", array('Foo\BarBBundle', 'BarBBundle', 'foo/', 'yml', false)),
            array(array('--dir' => $tmp, '--format' => 'yml', '--bundle-name' => 'BarCBundle', '--structure' => true), "Foo/BarCBundle\n", array('Foo\BarCBundle', 'BarCBundle', $tmp.'/', 'yml', true)),
        );
    }

    public function getNonInteractiveCommandData()
    {
        $tmp = sys_get_temp_dir();

        return array(
            array(array('--dir' => $tmp, '--namespace' => 'Foo/BarDBundle'), array('Foo\BarDBundle', 'FooBarDBundle', $tmp.'/', 'annotation', false)),
            array(array('--dir' => $tmp, '--namespace' => 'Foo/BarEBundle', '--format' => 'yml', '--bundle-name' => 'BarEBundle', '--structure' => true), array('Foo\BarEBundle', 'BarEBundle', $tmp.'/', 'yml', true)),
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
