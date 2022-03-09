<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Ui\Form\Component\Action\ActionResponder;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class SetActionResponse
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetActionResponse
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new SetActionResponse instance.
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
     * @param ActionResponder $responder
     */
    public function handle(ActionResponder $responder)
    {
        $actions = $this->builder->getFormActions();

        if ($this->builder->getFormResponse()) {
            return;
        }

        if ($this->builder->hasFormErrors()) {
            return;
        }

        if (!$this->builder->canSave()) {
            return;
        }

        if ($action = $actions->active()) {
            $responder->setFormResponse($this->builder, $action);
        }
    }
}
