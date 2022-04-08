<?php namespace Anomaly\Streams\Platform\Addon\FieldType;

/**
 * Class FieldTypeAccessor
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldTypeAccessor
{

    /**
     * The parent field type.
     *
     * @var FieldType
     */
    protected $fieldType;

    /**
     * Create a new FieldTypeAccessor instance.
     *
     * @param FieldType $fieldType
     */
    public function __construct(FieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Set the value.
     *
     * @param $value
     */
    public function set($value)
    {
        $entry = $this->fieldType->getEntry();

        $attributes = $entry->getAttributes();

        $attributes[$this->fieldType->getColumnName()] = $value;

        $entry->setRawAttributes($attributes);
    }

    /**
     * Get the value.
     *
     * @return mixed
     */
    public function get()
    {
        $entry = $this->fieldType->getEntry();

        $attributes = $entry->getAttributes();

        return array_get($attributes, $this->fieldType->getColumnName());
    }

    /**
     * Get the field type.
     *
     * @return FieldType
     */
    public function getFieldType()
    {
        return $this->fieldType;
    }

    /**
     * Set the field type.
     *
     * @param  FieldType $fieldType
     * @return $this
     */
    public function setFieldType(FieldType $fieldType)
    {
        $this->fieldType = $fieldType;

        return $this;
    }
}
