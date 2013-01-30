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
    ...

    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/nano-entertainment/NanoGeneratorBundle"
        }
    ],
    "require": {
        ...
        "nano-entertainment/generator-bundle": "dev-master"
    }
}
```



Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update nano-entertainment/generator-bundle
```


Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            ...
            
            $bundles[] = new Nano\Bundle\GeneratorBundle\NanoGeneratorBundle();
        }
}
```