NanoGeneratorBundle
===================

The `NanoGeneratorBundle` extends the default SensioGeneratorBundle

Features include:

- generate a layout.html.twig
- include base bootstrap css classes
- routes with bundle namespace

require a base.html.twig


Installation
------------

Add NanoGeneratorBundle to composer.json

```js
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/nano-entertainment/NanoGeneratorBundle"
        }
    ],
    "require-dev": {
        "nano-entertainment/generator-bundle": "dev-master"
    }
}
```



Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update --dev
```


Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            ...     
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Nano\Bundle\GeneratorBundle\NanoGeneratorBundle();
        }
}
```