<?php namespace Anomaly\SelectFieldType\Event;

use Anomaly\SelectFieldType\SelectFieldType;

/**
 * Class SetLayoutOptions
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetLayoutOptions
{

    /**
     * The field type instance.
     *
     * @var SelectFieldType
     */
    protected $fieldType;

    /**
     * Create a new SetLayoutOptions instance.
     *
     * @param SelectFieldType $fieldType
     */
    public function __construct(SelectFieldType $fieldType)
    {
        $this->fieldType = $fieldType;
    }

    /**
     * Get the field type.
     *
     * @return SelectFieldType
     */
    public function getFieldType()
    {
        return $this->fieldType;
    }

}
