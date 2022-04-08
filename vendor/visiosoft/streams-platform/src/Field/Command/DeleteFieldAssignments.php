<?php namespace Anomaly\Streams\Platform\Field\Command;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;

/**
 * Class DeleteFieldAssignments
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteFieldAssignments
{

    /**
     * The field instance.
     *
     * @var FieldInterface
     */
    protected $field;

    /**
     * Create a new DeleteFieldAssignments instance.
     *
     * @param FieldInterface $field
     */
    public function __construct(FieldInterface $field)
    {
        $this->field = $field;
    }

    /**
     * Handle the command.
     *
     * @param AssignmentRepositoryInterface $assignments
     */
    public function handle(AssignmentRepositoryInterface $assignments)
    {
        foreach ($this->field->getAssignments() as $assignment) {
            $assignments->delete($assignment);
        }
    }
}
