<?php namespace Anomaly\Streams\Platform\Http\Command;

use Anomaly\Streams\Platform\Http\HttpCache;

/**
 * Class PurgeHttpCache
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PurgeHttpCache
{

    /**
     * The path to purge.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new PurgeHttpCache instance.
     *
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if (!env('INSTALLED') || PHP_SAPI == 'cli' || !config('streams::httpcache.enabled')) {
            return;
        }

        /* @var HttpCache $cache */
        $cache = app(HttpCache::class);

        $cache->purge(parse_url($this->path, PHP_URL_PATH));
    }
}
