<?php namespace Anomaly\BooleanFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;

/**
 * Class BooleanFieldTypeModifier
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class BooleanFieldTypeModifier extends FieldTypeModifier
{

    /**
     * Modify the value.
     *
     * @param $value
     * @return int
     */
    public function modify($value)
    {
        return (int)filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Restore the value.
     *
     * @param $value
     * @return bool
     */
    public function restore($value)
    {
        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
