<?php namespace Anomaly\Streams\Platform\Entry\Command;

use Anomaly\Streams\Platform\Application\Application;
use Composer\Autoload\ClassLoader;

/**
 * Class AutoloadEntryModels
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AutoloadEntryModels
{

    /**
     * Handle the command.
     *
     * @param Application $application
     */
    public function handle(Application $application)
    {
        $loader = null;

        foreach (spl_autoload_functions() as $autoloader) {
            if (is_array($autoloader) && $autoloader[0] instanceof ClassLoader) {
                $loader = $autoloader[0];
            }
        }

        if (!$loader) {
            throw new \Exception("The ClassLoader could not be found.");
        }

        /*if (file_exists($classmap = $application->getStoragePath('models/classmap.php'))) {

            $loader->addClassMap(include $classmap);

            return;
        }*/

        /* @var ClassLoader $loader */
        $loader->addPsr4('Anomaly\Streams\Platform\Model\\', $application->getStoragePath('models'));

        $loader->register();
    }
}
