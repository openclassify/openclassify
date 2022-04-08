<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Field;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class FieldNormalizer
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldNormalizer
{

    /**
     * Normalize field input.
     *
     * @param FormBuilder $builder
     */
    public function normalize(FormBuilder $builder)
    {
        $fields = $builder->getFields();

        foreach ($fields as $slug => &$field) {

            /*
             * If the field is a wild card marker
             * then just continue.
             */
            if ($field == '*') {
                continue;
            }

            /*
             * If the slug is numeric and the field
             * is a string then use the field as is.
             */
            if (is_numeric($slug) && is_string($field)) {
                $field = [
                    'field' => $field,
                ];
            }

            /*
             * If the slug is a string and the field
             * is a string too then use the field as the
             * type and the field as well.
             */
            if (!is_numeric($slug) && is_string($slug) && is_string($field)) {
                $field = [
                    'field' => $slug,
                    'type'  => $field,
                ];
            }

            /*
             * If the field is an array and does not
             * have the field parameter set then
             * use the slug.
             */
            if (is_array($field) && !isset($field['field'])) {
                $field['field'] = $slug;
            }

            /*
             * If the field is required then it must have
             * the rule as well.
             */
            if (array_get($field, 'required') === true) {
                $field['rules'] = array_unique(array_merge(array_get($field, 'rules', []), ['required']));
            }
        }

        $builder->setFields(array_values($fields));
    }
}
