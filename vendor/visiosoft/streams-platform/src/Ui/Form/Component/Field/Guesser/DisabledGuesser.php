<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class DisabledGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DisabledGuesser
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
            if (in_array((string)$disabled = array_get($field, 'disabled', null), ['create', 'edit'])) {
                $field['disabled'] = $disabled === $mode;
            }
        }

        $builder->setFields($fields);
    }
}
