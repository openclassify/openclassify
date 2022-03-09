<?php namespace Anomaly\CountryFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;

/**
 * Class CountryFieldTypeModifier
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CountryFieldTypeModifier extends FieldTypeModifier
{

    /**
     * Modify the value.
     *
     * @param $value
     * @return string
     */
    public function modify($value)
    {
        return strtoupper($value);
    }

    /**
     * Restore the value.
     *
     * @param $value
     * @return string
     */
    public function restore($value)
    {
        return strtoupper($value);
    }
}
