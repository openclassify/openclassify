<?php namespace Visiosoft\ListFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;

/**
 * Class ListFieldTypeModifier
 *
 * @author        Dia shalabi. <dia@visiosoft.com.tr>
 * @package       Visiosoft\ListFieldType
 */
class ListFieldTypeModifier extends FieldTypeModifier
{

    /**
     * Return the serialized value.
     *
     * @param $value
     * @return string
     */
    public function modify($value)
    {
        if (is_string($value)){
            return $value;
        };

        return serialize(array_filter((array)$value));
    }

    /**
     * Restore the value.
     *
     * @param $value
     * @return mixed
     */
    public function restore($value)
    {
        if (!$value) {
            return [];
        }

        if (is_array($value)) {
            return array_filter($value);
        }

        return array_filter((array)unserialize($value));
    }
}
