<?php namespace Anomaly\Streams\Platform\Assignment\Command;

use Anomaly\Streams\Platform\Assignment\AssignmentSchema;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;

/**
 * Class RestoreAssignmentData
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class RestoreAssignmentData
{

    /**
     * The assignment interface.
     *
     * @var AssignmentInterface
     */
    protected $assignment;

    /**
     * Create a new RestoreAssignmentData instance.
     *
     * @param AssignmentInterface $assignment
     */
    public function __construct(AssignmentInterface $assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * Handle the command.
     *
     * @param AssignmentSchema $schema
     */
    public function handle(AssignmentSchema $schema, AssignmentRepositoryInterface $assignments)
    {
        $stream = $this->assignment->getStream();

        /* @var AssignmentInterface $assignment */
        $assignment = $assignments->find($this->assignment->getId());

        // If nothing is different then skip it.
        if ($assignment->isTranslatable() == $this->assignment->isTranslatable()) {
            return;
        }

        /*
         * If it's NOW translatable then
         * restore it to the main table.
         */
        if ($this->assignment->isTranslatable()) {
            $schema->restoreColumn($stream->getEntryTranslationsTableName(), $assignment->getFieldType(true), $this->assignment);
        }

        /*
         * If it's NOT translatable then back
         * it up from the translations table.
         */
        if (!$this->assignment->isTranslatable()) {
            $schema->restoreColumn($stream->getEntryTableName(), $assignment->getFieldType(true), $this->assignment);
        }
    }
}
