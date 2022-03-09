<?php namespace Anomaly\Streams\Platform\Routing\Command;

use Anomaly\Streams\Platform\Console\Kernel;

/**
 * Class CacheRoutes
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CacheRoutes
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
        if (file_exists($cache = base_path('bootstrap/cache/routes.php'))) {

            unlink($cache);

            $console->call('route:cache');
        }
    }
}
