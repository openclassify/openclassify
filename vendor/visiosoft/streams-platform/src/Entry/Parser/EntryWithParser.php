<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntryWithParser
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryWithParser
{

    /**
     * Parse the relation methods.
     *
     * @param  StreamInterface $stream
     * @return string
     */
    public function parse(StreamInterface $stream)
    {
        $relationships = [];

        if ($stream->isTranslatable()) {
            $relationships[] = '"translations"';
        }

        return '[' . implode(', ', $relationships) . ']';
    }

}
