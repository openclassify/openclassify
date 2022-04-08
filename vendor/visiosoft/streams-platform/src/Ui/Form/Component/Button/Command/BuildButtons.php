<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Button\Command;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Component\Button\ButtonBuilder;

class BuildButtons
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new BuildButtons instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param ButtonBuilder $builder
     */
    public function handle(ButtonBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
