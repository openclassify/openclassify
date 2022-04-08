<?php namespace Anomaly\Streams\Platform\Field\Command;

use Anomaly\Streams\Platform\Assignment\Command\RenameAssignmentColumn;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class RenameFieldAssignments
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RenameFieldAssignments
{
    use DispatchesJobs;

    /**
     * The field instance.
     *
     * @var FieldInterface
     */
    protected $field;

    /**
     * Create a new RenameFieldAssignments instance.
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
            $this->dispatchNow(new RenameAssignmentColumn($assignment->setRelation('field', $this->field)));
        }
    }
}
