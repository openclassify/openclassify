<?php namespace Visiosoft\ListFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class ListFieldTypePresenter
 *
 * @author        Dia shalabi. <dia@visiosoft.com.tr>
 * @package       Visiosoft\ListFieldType
 */
class ListFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The decorated object.
     * This is for IDE hinting.
     *
     * @var ListFieldType
     */
    protected $object;

    /**
     * Return the number of selections.
     *
     * @return int
     */
    public function count()
    {
        return count($this->values());
    }

    /**
     * Return the option values.
     *
     * @return array
     */
    public function values()
    {
        return array_values($this->selections());
    }

    public function selections()
    {
        return $this->object->getValue();
    }

}
