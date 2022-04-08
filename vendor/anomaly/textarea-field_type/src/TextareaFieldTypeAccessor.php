<?php namespace Anomaly\TextareaFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeAccessor;

class TextareaFieldTypeAccessor extends FieldTypeAccessor
{

    /**
     * Set the value.
     *
     * @param $value
     */
    public function set($value)
    {
        if ($this->fieldType->config('storage') == 'json') {
            $value = json_encode($value);
        }

        if ($this->fieldType->config('storage') == 'serialize') {
            $value = serialize($value);
        }

        parent::set($value);
    }

    /**
     * Get the value.
     *
     * @return mixed
     */
    public function get()
    {
        $value = parent::get();

        if ($this->fieldType->config('storage') == 'json') {
            $value = json_decode($value, true);
        }

        if ($this->fieldType->config('storage') == 'serialize') {
            $value = unserialize($value);
        }

        return $value;
    }


}
