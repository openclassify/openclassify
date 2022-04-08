<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class LoadFormValues
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadFormValues
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new LoadFormValues instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        if ($this->builder->hasFormErrors()) {
            return;
        }

        /* @var FieldType $field */
        foreach ($this->builder->getEnabledFormFields() as $field) {
            $this->builder->setFormValue($field->getInputName(), $field->getInputValue());
        }
    }
}
