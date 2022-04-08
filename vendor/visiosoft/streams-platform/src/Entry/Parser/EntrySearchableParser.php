<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

class EntrySearchableParser
{

    /**
     * Return the use statement for trashable if so.
     *
     * @param  StreamInterface $stream
     * @return string
     */
    public function parse(StreamInterface $stream)
    {
        if (!$stream->isSearchable()) {
            return "false";
        }

        return "true";
    }
}
