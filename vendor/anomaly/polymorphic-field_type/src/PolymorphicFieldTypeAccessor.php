<?php namespace Anomaly\PolymorphicFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeAccessor;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class PolymorphicFieldTypeAccessor
 *
 * @link          http://pyrocms.com
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PolymorphicFieldTypeAccessor extends FieldTypeAccessor
{

    /**
     * Set the value on the entry.
     *
     * @param $value
     */
    public function set($value)
    {
        if ($value instanceof EloquentModel) {

            $entry = $this->fieldType->getEntry();

            $attributes = $entry->getAttributes();

            $attributes[$this->fieldType->getColumnName() . '_id']   = $value->getId();
            $attributes[$this->fieldType->getColumnName() . '_type'] = get_class($value);

            $entry->setRawAttributes($attributes);
        } else {
            parent::set($value);
        }
    }
}
