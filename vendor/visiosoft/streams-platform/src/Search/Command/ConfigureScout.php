<?php namespace Anomaly\Streams\Platform\Search\Command;

use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Filesystem\Filesystem;

/**
 * Class ConfigureScout
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigureScout
{

    /**
     * Handle the command.
     *
     * @param Application $application
     */
    public function handle(Application $application, Filesystem $files)
    {
        $files->makeDirectory($application->getStoragePath('search'), 0777, true, true);

        config()->set('scout.tntsearch.storage', $application->getStoragePath('search'));
    }
}
