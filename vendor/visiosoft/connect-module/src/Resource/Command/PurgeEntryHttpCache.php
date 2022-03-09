<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Anomaly\Streams\Platform\Entry\Event\EntryWasSaved;
use Anomaly\Streams\Platform\Http\HttpCache;

/**
 * Class PurgeEntryHttpCache
 *

 */
class PurgeEntryHttpCache
{

    /**
     * Handle the event.
     *
     * @param EntryWasSaved $event
     * @internal param HttpCache $cache
     */
    public function handle(EntryWasSaved $event)
    {
        if (!env('INSTALLED') || PHP_SAPI == 'cli' || !config('streams::httpcache.enabled')) {
            return;
        }

        /* @var HttpCache $cache */
        $cache = app(HttpCache::class);

        $entry = $event->getEntry();

        $id        = $entry->getId();
        $stream    = $entry->getStreamSlug();
        $namespace = $entry->getStreamNamespace();

        $cache->purge("/api/entries/{$namespace}/{$stream}");
        $cache->purge("/api/entries/{$namespace}/{$stream}/{$id}");
    }

}
