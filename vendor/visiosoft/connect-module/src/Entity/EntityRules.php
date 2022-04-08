<?php namespace Anomaly\Streams\Platform\Ui\Entity;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class EntityRules
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity
 */
class EntityRules
{

    /**
     * Compile rules from entity fields.
     *
     * @param EntityBuilder $builder
     * @return array
     */
    public function compile(EntityBuilder $builder)
    {
        $rules = [];

        $entry  = $builder->getEntityEntry();
        $stream = $builder->getEntityStream();

        /* @var FieldType $field */
        foreach ($builder->getEnabledEntityFields() as $field) {

            if ($field->isDisabled()) {
                continue;
            }

            if (in_array($field->getField(), $builder->getSkips())) {
                continue;
            }

            $fieldRules = array_filter(array_unique($field->getRules()));

            if (!$stream instanceof StreamInterface) {

                $rules[$field->getInputName()] = implode('|', $fieldRules);

                continue;
            }

            if ($assignment = $stream->getAssignment($field->getField())) {

                $type = $assignment->getFieldType();

                if ($type->isRequired()) {
                    $fieldRules[] = 'required';
                }

                if (!isset($fieldRules['unique']) && $assignment->isUnique() && !$assignment->isTranslatable()) {

                    $unique = 'unique:' . $stream->getEntryTableName() . ',' . $field->getColumnName();

                    if ($entry && $id = $entry->getId()) {
                        $unique .= ',' . $id;
                    }

                    $fieldRules[] = $unique;
                }

                if ($assignment->isTranslatable() && $field->getLocale() !== config('app.fallback_locale')) {
                    $fieldRules = array_diff($fieldRules, ['required']);
                }
            }

            $rules[$field->getInputName()] = implode('|', array_unique($fieldRules));
        }

        return array_filter($rules);
    }
}
