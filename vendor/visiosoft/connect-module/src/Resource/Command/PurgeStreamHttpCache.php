<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Anomaly\Streams\Platform\Entry\Event\EntryWasSaved;
use Anomaly\Streams\Platform\Http\HttpCache;
use Anomaly\Streams\Platform\Stream\Event\StreamWasSaved;

/**
 * Class PurgeStreamHttpCache
 *

 */
class PurgeStreamHttpCache
{

    /**
     * Handle the event.
     *
     * @param EntryWasSaved $event
     * @internal param HttpCache $cache
     */
    public function handle(StreamWasSaved $event)
    {
        if (!env('INSTALLED') || PHP_SAPI == 'cli' || !config('streams::httpcache.enabled')) {
            return;
        }

        /* @var HttpCache $cache */
        $cache = app(HttpCache::class);

        $stream = $event->getStream();

        $slug      = $stream->getSlug();
        $namespace = $stream->getNamespace();

        $cache->purge("/api/streams");
        $cache->purge("/api/streams/{$namespace}");
        $cache->purge("/api/streams/{$namespace}/{$slug}");
    }

}
