<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntryFieldSlugsParser
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryFieldSlugsParser
{

    /**
     * Return the entry model base namespace.
     *
     * @param  StreamInterface $stream
     * @return string
     */
    public function parse(StreamInterface $stream)
    {
        $string = "[";

        foreach ($stream->getAssignmentFieldSlugs() as $slug) {
            $string .= "\n        '{$slug}',";
        }

        $string .= "\n]";

        return $string;
    }
}
