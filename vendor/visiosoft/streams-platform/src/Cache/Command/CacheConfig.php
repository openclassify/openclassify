<?php namespace Anomaly\Streams\Platform\Cache\Command;

use Anomaly\Streams\Platform\Console\Kernel;

/**
 * Class CacheConfig
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @deprecated v1.7.30 Has been replaced with a PSR-4 compliant class.
 * @see Anomaly\Streams\Platform\Config\Command\CacheConfig
 */
class CacheConfig
{

    /**
     * Handle the command.
     *
     * @param Kernel $console
     */
    public function handle(Kernel $console)
    {

        /**
         * Queue the routes to re-cache if
         * a cache file exists in bootstrap.
         */
        if (file_exists($cache = base_path('bootstrap/cache/config.php'))) {

            unlink($cache);

            $console->call('config:cache');
        }
    }
}
