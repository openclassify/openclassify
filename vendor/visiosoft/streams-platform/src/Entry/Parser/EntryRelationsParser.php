<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntryRelationsParser
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryRelationsParser
{

    /**
     * Parse the relation methods.
     *
     * @param  StreamInterface $stream
     * @return string
     */
    public function parse(StreamInterface $stream)
    {
        $string = '';

        $assignments = $stream->getAssignments();

        foreach ($assignments->relations() as $assignment) {
            $this->parseAssignment($assignment, $string);
        }

        return $string;
    }

    /**
     * Parse an assignment relation.
     *
     * @param AssignmentInterface $assignment
     * @param                     $string
     */
    protected function parseAssignment(AssignmentInterface $assignment, &$string)
    {
        $fieldType = $assignment->getFieldType();

        $parser = $fieldType->getParser();

        $string .= $parser->relation($assignment);
    }
}
