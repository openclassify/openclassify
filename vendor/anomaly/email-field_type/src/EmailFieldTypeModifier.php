<?php namespace Anomaly\EmailFieldType;

use Anomaly\EmailFieldType\Validator\NoLocal;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;

/**
 * Class EmailFieldTypeModifier
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class EmailFieldTypeModifier extends FieldTypeModifier
{

    /**
     * Modify the value.
     *
     * @param $value
     * @return null|string
     */
    public function modify($value)
    {
        if ($value && !$this->validate($value)) {
            $value = null;
        }

        return parent::modify($value);
    }

    /**
     * Restore the value.
     *
     * @param $value
     * @return null|string
     */
    public function restore($value)
    {
        if ($value && !$this->validate($value)) {
            $value = null;
        }

        return parent::restore($value);
    }

    /**
     * Validate the email.
     *
     * @param $value
     * @return bool
     */
    protected function validate($value)
    {
        $parts = explode('@', $value);
        
        return (bool) filter_var('https://' . end($parts), FILTER_VALIDATE_URL);
    }
}
