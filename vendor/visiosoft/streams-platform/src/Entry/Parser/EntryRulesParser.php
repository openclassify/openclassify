<?php namespace Anomaly\Streams\Platform\Entry\Parser;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\StreamModel;

/**
 * Class EntryRulesParser
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EntryRulesParser
{

    /**
     * Return the entry validation rules.
     *
     * @param  StreamModel $stream
     * @return string
     */
    public function parse(StreamInterface $stream)
    {
        $string = '[';

        foreach ($stream->getAssignments() as $assignment) {
            $this->parseAssignmentRules($stream, $assignment, $string);
        }

        $string .= "\n]";

        return $string;
    }

    /**
     * Parse the assignment rules.
     *
     * @param StreamInterface     $stream
     * @param AssignmentInterface $assignment
     * @param                     $string
     */
    protected function parseAssignmentRules(StreamInterface $stream, AssignmentInterface $assignment, &$string)
    {
        $rules = [];

        if ($assignment->isRequired()) {
            $rules[] = 'required';
        }

        if ($assignment->isUnique()) {
            $rules[] = 'unique:' . $stream->getEntryTableName() . ',' . $assignment->getColumnName();
        }

        if (is_array($rules)) {
            $rules = implode('|', array_filter($rules));

            $rules = addcslashes($rules, "'");
            $fieldSlug = addcslashes($assignment->getFieldSlug(), "'");

            $string .= "\n        '{$fieldSlug}' => '{$rules}',";
        }
    }
}
