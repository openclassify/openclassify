<?php namespace Visiosoft\ConnectModule\Command;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Http\HttpCache;

/**
 * Class PurgeHttpCache
 *

 */
class PurgeHttpCache
{

    /**
     * The entry instance.
     *
     * @var EntryInterface
     */
    protected $entry;

    /**
     * Create a new PurgeHttpCache instance.
     *
     * @param EntryInterface $entry
     */
    public function __construct(EntryInterface $entry)
    {
        $this->entry = $entry;
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

        $stream    = $this->entry->getStreamSlug();
        $namespace = $this->entry->getStreamNamespace();
dd(array_filter(
    [
        "api/entries/{$namespace}/{$stream}",
        "api/entries/{$namespace}/{$stream}/{id}",
    ]
));
        array_map(
            function ($route) use ($cache) {
                $cache->purge(parse_url($route, PHP_URL_PATH));
            },
            array_filter(
                [
                    "api/entries/{$namespace}/{$stream}",
                    "api/entries/{$namespace}/{$stream}/{id}",
                ]
            )
        );
    }
}
