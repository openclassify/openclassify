<?php namespace Anomaly\Streams\Platform\Database\Migration\Stream;

use Anomaly\Streams\Platform\Database\Migration\Migration;

class StreamNormalizer
{

    /**
     * Normalize the streams input.
     *
     * @param Migration $migration
     */
    public function normalize(Migration $migration)
    {
        $stream = $migration->getStream();

        if (is_string($stream)) {
            $stream = [
                'slug' => $stream,
            ];
        }

        $stream['slug']      = array_get($stream, 'slug', $migration->contextualNamespace());
        $stream['namespace'] = array_get($stream, 'namespace', $migration->contextualNamespace());
        
        $migration->setStream($stream);
    }
}
