<?php


namespace Nano\Bundle\GeneratorBundle\Generator;

use Sensio\Bundle\GeneratorBundle\Generator\BundleGenerator as SensioBundleGenerator;



/**
 * Generates a bundle.
 *
 */
class BundleGenerator extends SensioBundleGenerator
{


    public function generate($namespace, $bundle, $dir, $format, $structure)
    {
        $dir .= '/'.strtr($namespace, '\\', '/');
        if (file_exists($dir)) {
            if (!is_dir($dir)) {
                throw new \RuntimeException(sprintf('Unable to generate the bundle as the target directory "%s" exists but is a file.', realpath($dir)));
            }
            $files = scandir($dir);
            if ($files != array('.', '..')) {
                throw new \RuntimeException(sprintf('Unable to generate the bundle as the target directory "%s" is not empty.', realpath($dir)));
            }
            if (!is_writable($dir)) {
                throw new \RuntimeException(sprintf('Unable to generate the bundle as the target directory "%s" is not writable.', realpath($dir)));
            }
        }

        $basename = substr($bundle, 0, -6);
        $parameters = array(
            'namespace' => $namespace,
            'bundle'    => $bundle,
            'format'    => $format,
            'bundle_basename' => $basename,
            'extension_alias' => Container::underscore($basename),
        );

        $this->renderFile($this->skeletonDir, 'Bundle.php', $dir.'/'.$bundle.'.php', $parameters);
        $this->renderFile($this->skeletonDir, 'Extension.php', $dir.'/DependencyInjection/'.$basename.'Extension.php', $parameters);
        $this->renderFile($this->skeletonDir, 'Configuration.php', $dir.'/DependencyInjection/Configuration.php', $parameters);
        $this->renderFile($this->skeletonDir, 'layout.html.twig', $dir.'/Resources/views/layout.html.twig', $parameters);

        if ('xml' === $format || 'annotation' === $format) {
            $this->renderFile($this->skeletonDir, 'services.xml', $dir.'/Resources/config/services.xml', $parameters);
        } else {
            $this->renderFile($this->skeletonDir, 'services.'.$format, $dir.'/Resources/config/services.'.$format, $parameters);
        }

        if ('annotation' != $format) {
            $this->renderFile($this->skeletonDir, 'routing.'.$format, $dir.'/Resources/config/routing.'.$format, $parameters);
        }

        if ($structure) {
            $this->filesystem->mkdir($dir.'/Resources/doc');
            $this->filesystem->touch($dir.'/Resources/doc/index.rst');
            $this->filesystem->mkdir($dir.'/Resources/translations');
            $this->filesystem->copy($this->skeletonDir.'/messages.de.xlf', $dir.'/Resources/translations/messages.de.xlf');
            $this->filesystem->mkdir($dir.'/Resources/public/css');
            $this->filesystem->mkdir($dir.'/Resources/public/images');
            $this->filesystem->mkdir($dir.'/Resources/public/js');
        }
    }
}
