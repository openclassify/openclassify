<?php namespace Anomaly\Streams\Platform\Ui\Entity;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class EntityAttributes
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity
 */
class EntityAttributes
{

    /**
     * Make custom validation messages.
     *
     * @param EntityBuilder $builder
     * @return array
     */
    public function make(EntityBuilder $builder)
    {
        $attributes = [];

        /* @var FieldType $field */
        foreach ($builder->getEnabledEntityFields() as $field) {

            $label = $field->getLabel();

            if (str_contains($label, '::')) {
                $label = trans($label);
            }

            if ($locale = $field->getLocale()) {
                $label .= ' (' . $locale . ')';
            }

            $attributes[$field->getInputName()] = $label;
        }

        return $attributes;
    }
}
