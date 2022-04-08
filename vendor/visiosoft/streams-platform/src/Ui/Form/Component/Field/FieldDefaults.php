<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FieldDefaults
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldDefaults
{

    /**
     * Default the form fields when none are defined.
     *
     * @param FormBuilder $builder
     */
    public function defaults(FormBuilder $builder)
    {
        if ($builder->getFields() === []) {
            $builder->setFields(['*']);
        }
    }
}
