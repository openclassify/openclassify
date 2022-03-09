<?php namespace Anomaly\Streams\Platform\Http\Command;

use Illuminate\Filesystem\Filesystem;

/**
 * Class ClearHttpCache
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ClearHttpCache
{

    /**
     * Handle the command.
     *
     * @param Filesystem $files
     * @internal param Container $container
     */
    public function handle(Filesystem $files)
    {
        foreach ($files->directories(config('httpcache.cache_dir', storage_path('httpcache'))) as $directory) {
            $files->deleteDirectory($directory);
        }
    }
}
