<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntryTitleParser
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryTitleParser
{

    /**
     * Return the title key for an entry model.
     *
     * @param  StreamInterface $stream
     * @return mixed
     */
    public function parse(StreamInterface $stream)
    {
        return $stream->getTitleColumn();
    }
}
