<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action\Command;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Component\Action\ActionBuilder;

class BuildActions
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new BuildActions instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Build actions and load them to the form.
     *
     * @param ActionBuilder $builder
     */
    public function handle(ActionBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
