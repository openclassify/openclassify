<?php namespace Anomaly\Streams\Platform\Ui\Form;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class FormRules
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FormRules
{

    /**
     * Compile rules from form fields.
     *
     * @param  FormBuilder $builder
     * @return array
     */
    public function compile(FormBuilder $builder)
    {
        $rules  = $builder->getRules();
        $entry  = $builder->getFormEntry();
        $stream = $builder->getFormStream();

        $locale = config('app.locale', config('streams::locales.default'));

        /* @var FieldType $field */
        foreach ($builder->getEnabledFormFields() as $field) {

            if ($field->isDisabled()) {
                continue;
            }

            if (in_array($field->getField(), $builder->getSkips())) {
                continue;
            }

            $fieldRules = array_filter(array_unique($field->getRules()));

            $rules = $field->extendRules($rules);

            if (!$stream instanceof StreamInterface) {

                $rules[$field->getInputName()] = array_merge(
                    array_unique($fieldRules),
                    array_get($rules, $field->getInputName(), [])
                );

                continue;
            }

            if ($assignment = $stream->getAssignment($field->getField())) {

                $type = $assignment->getFieldType();

                if ($type->isRequired()) {
                    $fieldRules[] = 'required';
                }

                if (!isset($fieldRules['unique']) && $assignment->isUnique() && !$assignment->isTranslatable()) {

                    $unique = 'unique:' . $stream->getEntryTableName() . ',' . $field->getUniqueColumnName();

                    if ($entry && $id = $entry->getId()) {
                        $unique .= ',' . $id;
                    }

                    $fieldRules[] = $unique;
                }

                if ($assignment->isTranslatable() && $field->getLocale() !== $locale) {
                    $fieldRules = array_diff($fieldRules, ['required']);
                }
            }

            $rules[$field->getInputName()] = array_merge(
                array_unique($fieldRules),
                array_get($rules, $field->getInputName(), [])
            );
        }

        /**
         * Make sure the rules for each
         * field are in pipe format.
         */
        array_walk(
            $rules,
            function (&$rules) {
                $rules = implode('|', array_unique((array)$rules));
            }
        );

        return array_filter($rules);
    }
}
