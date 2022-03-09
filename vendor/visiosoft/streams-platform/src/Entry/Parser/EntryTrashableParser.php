<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntryTrashableParser
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryTrashableParser
{

    /**
     * Return the use statement for trashable if so.
     *
     * @param  StreamInterface $stream
     * @return string
     */
    public function parse(StreamInterface $stream)
    {
        if (!$stream->isTrashable()) {
            return null;
        }

        return "use \\Illuminate\\Database\\Eloquent\\SoftDeletes;";
    }
}
