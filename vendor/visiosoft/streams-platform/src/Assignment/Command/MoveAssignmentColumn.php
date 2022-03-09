<?php namespace Anomaly\Streams\Platform\Assignment\Command;

use Anomaly\Streams\Platform\Assignment\AssignmentSchema;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;

/**
 * Class MoveAssignmentColumn
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class MoveAssignmentColumn
{

    /**
     * The assignment interface.
     *
     * @var AssignmentInterface
     */
    protected $assignment;

    /**
     * Create a new MoveAssignmentColumn instance.
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
         * If it's NOW translatable then move it from
         * the main table to the translations table.
         */
        if ($this->assignment->isTranslatable()) {
            $schema->dropIndex($stream->getEntryTableName(), $assignment->getFieldType(true), $assignment);
            $schema->dropColumn($stream->getEntryTableName(), $assignment->getFieldType(true), $assignment);
            $schema->addColumn($stream->getEntryTranslationsTableName(), $assignment->getFieldType(true), $assignment);
        }

        /*
         * If it's NOT translatable then move it from
         * the translations table to the main table.
         */
        if (!$this->assignment->isTranslatable()) {
            $schema->dropIndex($stream->getEntryTranslationsTableName(), $assignment->getFieldType(true), $assignment);
            $schema->dropColumn($stream->getEntryTranslationsTableName(), $assignment->getFieldType(true), $assignment);
            $schema->addColumn($stream->getEntryTableName(), $assignment->getFieldType(true), $assignment);
        }
    }
}
