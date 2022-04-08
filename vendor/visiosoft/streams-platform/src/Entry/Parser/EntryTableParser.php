<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntryTableParser
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryTableParser
{

    /**
     * Return the entry table name.
     *
     * @param  StreamInterface $stream
     * @return mixed
     */
    public function parse(StreamInterface $stream)
    {
        return $stream->getEntryTableName();
    }
}
