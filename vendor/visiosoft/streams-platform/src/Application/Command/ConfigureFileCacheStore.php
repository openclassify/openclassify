<?php namespace Anomaly\Streams\Platform\Application\Command;

use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Contracts\Config\Repository;

/**
 * Class ConfigureFileCacheStore
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ConfigureFileCacheStore
{

    /**
     * Handle the command.
     *
     * @param Repository  $config
     * @param Application $application
     */
    public function handle(Repository $config, Application $application)
    {
        $config->set('cache.stores.file.path', $application->getStoragePath('cache'));
    }
}
