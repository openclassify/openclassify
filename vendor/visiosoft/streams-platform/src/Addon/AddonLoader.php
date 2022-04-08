<?php namespace Anomaly\Streams\Platform\Addon;

use Composer\Autoload\ClassLoader;
use Symfony\Component\Process\Process;

/**
 * Class AddonLoader
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class AddonLoader
{

    /**
     * The class loader instance.
     *
     * @var ClassLoader
     */
    protected $loader;

    /**
     * Create a new AddonLoader instance.
     */
    public function __construct()
    {
        foreach (spl_autoload_functions() as $loader) {
            if (is_array($loader) && $loader[0] instanceof ClassLoader) {
                $this->loader = $loader[0];
            }
        }

        if (!$this->loader) {
            throw new \Exception("The ClassLoader could not be found.");
        }
    }

    /**
     * Load the addon.
     *
     * @param $path
     * @return $this
     */
    public function load($path)
    {

        if (is_array($path) && $paths = $path) {

            foreach ($paths as $path) {
                $this->load($path);
            }

            return $this;
        }

        if (file_exists($autoload = $path . '/vendor/autoload.php')) {

            include $autoload;

            return $this;
        }

        if (!file_exists($path . '/composer.json')) {
            return $this;
        }

        if (!$composer = json_decode(file_get_contents($path . '/composer.json'), true)) {
            throw new \Exception("A JSON syntax error was encountered in {$path}/composer.json");
        }

        if (!array_key_exists('autoload', $composer)) {
            return $this;
        }

        foreach (array_get($composer['autoload'], 'psr-4', []) as $namespace => $autoload) {
            $this->loader->addPsr4($namespace, $path . '/' . $autoload, false);
        }

        foreach (array_get($composer['autoload'], 'psr-0', []) as $namespace => $autoload) {
            $this->loader->add($namespace, $path . '/' . $autoload, false);
        }

        foreach (array_get($composer['autoload'], 'files', []) as $file) {
            include($path . '/' . $file);
        }

        if ($classmap = array_get($composer['autoload'], 'classmap')) {
            $this->loader->addClassMap($classmap);
        }

        return $this;
    }

    /**
     * Register the loader.
     *
     * return $this
     */
    public function register()
    {
        $this->loader->register();

        return $this;
    }

    /**
     * Return the class loader.
     *
     * @return ClassLoader
     */
    public function classLoader()
    {
        return $this->loader;
    }

    /**
     * Dump the autoloader.
     *
     * return $this
     */
    public function dump()
    {
        $process = new Process(['composer dump-autoload']);

        $process->run();
        $process->wait();

        return $this;
    }
}
