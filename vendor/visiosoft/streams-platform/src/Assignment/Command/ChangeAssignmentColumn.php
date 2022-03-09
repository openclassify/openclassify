<?php namespace Anomaly\Streams\Platform\Assignment\Command;

use Anomaly\Streams\Platform\Assignment\AssignmentSchema;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;

/**
 * Class ChangeAssignmentColumn
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ChangeAssignmentColumn
{

    /**
     * The assignment interface.
     *
     * @var AssignmentInterface
     */
    protected $assignment;

    /**
     * Create a new ChangeAssignmentColumn instance.
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
     * @param AssignmentSchema              $schema
     * @param AssignmentRepositoryInterface $assignments
     */
    public function handle(AssignmentSchema $schema, AssignmentRepositoryInterface $assignments)
    {
        $stream = $this->assignment->getStream();
        $type   = $this->assignment->getFieldType(true);

        if (!$this->assignment->isTranslatable()) {
            $table = $stream->getEntryTableName();
        } else {
            $table = $stream->getEntryTranslationsTableName();
        }

        /* @var AssignmentInterface $assignment */
        $assignment = $assignments->find($this->assignment->getId());

        $assignment = clone($assignment);

        $schema->renameColumn($table, $type, $assignment);
    }
}
