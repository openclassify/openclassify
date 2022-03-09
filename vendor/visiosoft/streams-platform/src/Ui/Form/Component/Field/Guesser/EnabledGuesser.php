<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class EnabledGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EnabledGuesser
{

    /**
     * Guess the field instructions.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $fields = $builder->getFields();
        $mode   = $builder->getFormMode();

        foreach ($fields as &$field) {

            // Guess based on the form mode if applicable.
            if (in_array((string)$enabled = array_get($field, 'enabled', null), ['create', 'edit'])) {
                $field['enabled'] = $enabled === $mode;
            }
        }

        $builder->setFields($fields);
    }
}
