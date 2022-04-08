<?php namespace Anomaly\TagsFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;

/**
 * Class TagsFieldTypeModifier
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TagsFieldTypeModifier extends FieldTypeModifier
{

    /**
     * Return the serialized value.
     *
     * @param $value
     * @return string
     */
    public function modify($value)
    {
        if (is_string($value)) {
            $value = explode(',', $value);
        }

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

        try {
            return array_filter((array)unserialize($value));
        } catch (\Exception $e) {
            return [];
        }
    }
}
