<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntryRelationshipsParser
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryRelationshipsParser
{

    /**
     * Return the relationships attribute.
     *
     * @param  StreamInterface $stream
     * @return string
     */
    public function parse(StreamInterface $stream)
    {
        $relationships = [];

        /* @var AssignmentInterface $assignment */
        foreach ($stream->getRelationshipAssignments() as $assignment) {
            $relationships[] = "'{$assignment->getFieldSlug()}'";
        }

        return "[" . implode(', ', $relationships) . "]";
    }
}
