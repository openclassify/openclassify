<?php namespace Anomaly\Streams\Platform\Ui\Form\Command;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Session\Store;

/**
 * Class FlashFieldValues
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FlashFieldValues
{

    /**
     * The form builder.
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create a new FlashFieldValues instance.
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the event.
     *
     * @param Store $session
     */
    public function handle(Store $session)
    {
        if (!$this->builder->hasFormErrors()) {
            return;
        }

        /* @var FieldType $field */
        foreach ($this->builder->getFormFields() as $field) {
            $session->flash($field->getFieldName(), $field->getRepopulateValue());
        }
    }
}
