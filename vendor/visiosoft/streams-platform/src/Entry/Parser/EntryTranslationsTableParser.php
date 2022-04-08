<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntryTranslationsTableParser
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryTranslationsTableParser
{

    /**
     * Return the entry translations table name.
     *
     * @param  StreamInterface $stream
     * @return mixed
     */
    public function parse(StreamInterface $stream)
    {
        return $stream->getEntryTranslationsTableName();
    }
}
