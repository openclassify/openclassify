<?php namespace Anomaly\IntegerFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier;

/**
 * Class IntegerFieldTypeModifier
 *  
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class IntegerFieldTypeModifier extends FieldTypeModifier
{

    /**
     * Modify the value
     * as it's being set.
     *
     * @param $value
     * @return mixed
     */
    public function modify($value)
    {
        if (is_null($value) && !$this->fieldType->isRequired()){
           return parent::modify($value);
        }
        
        if (!is_integer($value)) {
            $value = (int)preg_replace('/\D/', '', $value);
        }

        return parent::modify($value);
    }
}
