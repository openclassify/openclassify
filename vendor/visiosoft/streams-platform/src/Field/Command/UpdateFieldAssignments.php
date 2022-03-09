<?php namespace Anomaly\Streams\Platform\Field\Command;

use Anomaly\Streams\Platform\Assignment\Command\UpdateAssignmentColumn;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UpdateFieldAssignments
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UpdateFieldAssignments
{
    use DispatchesJobs;

    /**
     * The field instance.
     *
     * @var FieldInterface
     */
    protected $field;

    /**
     * Create a new UpdateFieldAssignments instance.
     *
     * @param FieldInterface $field
     */
    public function __construct(FieldInterface $field)
    {
        $this->field = $field;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        foreach ($this->field->getAssignments() as $assignment) {
            $this->dispatchNow(new UpdateAssignmentColumn($assignment->setRelation('field', $this->field)));
        }
    }
}
