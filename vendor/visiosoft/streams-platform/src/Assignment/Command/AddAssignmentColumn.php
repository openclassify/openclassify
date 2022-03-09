<?php namespace Anomaly\Streams\Platform\Assignment\Command;

use Anomaly\Streams\Platform\Assignment\AssignmentSchema;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;

class AddAssignmentColumn
{

    /**
     * The assignment interface.
     *
     * @var AssignmentInterface
     */
    protected $assignment;

    /**
     * Create a new AddAssignmentColumn instance.
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
    public function handle(AssignmentSchema $schema)
    {
        $stream = $this->assignment->getStream();
        $type   = $this->assignment->getFieldType();

        if (!$this->assignment->isTranslatable()) {
            $table = $stream->getEntryTableName();
        } else {
            $table = $stream->getEntryTranslationsTableName();
        }

        $schema->addColumn($table, $type, $this->assignment);
        $schema->addIndex($table, $type, $this->assignment);
    }
}
