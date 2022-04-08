<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field\Guesser;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class NullableGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class NullableGuesser
{

    /**
     * Guess the nullable rule.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $fields = $builder->getFields();

        foreach ($fields as &$field) {

            $rules = array_get($field, 'rules', []);

            if (is_string($rules)) {
                $rules = explode('|', $rules);
            }

            // Skip if already nullable.
            if (in_array('nullable', $rules)) {
                continue;
            }

            /**
             * If the field depends on other fields we
             * won't add nullable here because validation
             * will not be performed on this particular field.
             */
            if ($rules && preg_grep('/required_.*/', $rules)) {
                continue;
            }

            /**
             * If specifically not
             * required then nullable.
             */
            if (array_get($field, 'required', false) == false) {
                $field['rules'][] = 'nullable';
            }
        }

        $builder->setFields($fields);
    }
}
