<?php namespace Anomaly\Streams\Platform\Field\Form\Command;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Field\Form\FieldFormBuilder;

/**
 * Class AutoAssignField
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AutoAssignField
{

    /**
     * The field form builder.
     *
     * @var FieldFormBuilder
     */
    protected $builder;

    /**
     * Create a new AutoAssignField instance.
     *
     * @param FieldFormBuilder $builder
     */
    public function __construct(FieldFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param AssignmentRepositoryInterface $assignments
     */
    public function handle(AssignmentRepositoryInterface $assignments)
    {
        if ($this->builder->getFormOption('auto_assign') === true && $this->builder->getFormMode() === 'create') {
            $field  = $this->builder->getFormEntry();
            $stream = $this->builder->getStream();

            $assignments->create(
                [
                    'stream_id' => $stream->getId(),
                    'field_id'  => $field->getId(),
                ]
            );
        }
    }
}
