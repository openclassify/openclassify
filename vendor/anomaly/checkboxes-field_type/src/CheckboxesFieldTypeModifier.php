<?php namespace Anomaly\CheckboxesFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;

/**
 * Class CheckboxesFieldTypeModifier
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CheckboxesFieldType
 */
class CheckboxesFieldTypeModifier extends FieldTypeModifier
{

    /**
     * Return the serialized value.
     *
     * @param $value
     * @return string
     */
    public function modify($value)
    {
        if (is_string($value) && unserialize($value) !== false) {
            return $value;
        }

        return serialize((array)$value);
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
            return $value;
        }

        return (array)unserialize($value);
    }
}
