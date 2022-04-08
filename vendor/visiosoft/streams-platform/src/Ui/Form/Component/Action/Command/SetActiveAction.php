<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action\Command;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class SetActiveAction
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new BuildFormFiltersCommand instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Set the active action.
     */
    public function handle()
    {
        $options = $this->builder->getFormOptions();
        $actions = $this->builder->getFormActions();

        if ($action = $actions->findBySlug(app('request')->get($options->get('prefix') . 'action'))) {
            $action->setActive(true);
        }

        if (!$action && $action = $actions->first()) {
            $action->setActive(true);
        }
    }
}
