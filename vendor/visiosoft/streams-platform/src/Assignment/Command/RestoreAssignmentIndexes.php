<?php namespace Anomaly\Streams\Platform\Assignment\Command;

use Anomaly\Streams\Platform\Assignment\AssignmentSchema;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;

/**
 * Class RestoreAssignmentIndexes
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class RestoreAssignmentIndexes
{

    /**
     * The assignment interface.
     *
     * @var AssignmentInterface
     */
    protected $assignment;

    /**
     * Create a new RestoreAssignmentIndexes instance.
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

        if (!$this->assignment->isTranslatable()) {
            $schema->addIndex($stream->getEntryTableName(), $assignment->getFieldType(true), $this->assignment);
        }
    }
}
