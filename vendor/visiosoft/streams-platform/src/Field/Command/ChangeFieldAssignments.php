<?php namespace Anomaly\Streams\Platform\Field\Command;

use Anomaly\Streams\Platform\Assignment\Command\ChangeAssignmentColumn;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class ChangeFieldAssignments
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ChangeFieldAssignments
{

    use DispatchesJobs;

    /**
     * The field instance.
     *
     * @var FieldInterface
     */
    protected $field;

    /**
     * Create a new ChangeFieldAssignments instance.
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
            $this->dispatchNow(new ChangeAssignmentColumn($assignment->setRelation('field', $this->field)));
        }
    }
}
