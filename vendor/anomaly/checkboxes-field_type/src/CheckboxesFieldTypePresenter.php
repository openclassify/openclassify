<?php namespace Anomaly\CheckboxesFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class CheckboxesFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CheckboxesFieldType
 */
class CheckboxesFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The decorated object.
     * This is for IDE hinting.
     *
     * @var CheckboxesFieldType
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
     * Return the number of options.
     *
     * @return int
     */
    public function total()
    {
        return count($this->object->getOptions());
    }

    /**
     * Return the option keys.
     *
     * @return array
     */
    public function keys()
    {
        return array_keys($this->selections());
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

    /**
     * Return the selections array.
     *
     * @return array
     */
    public function selections()
    {
        $value   = $this->object->getValue();
        $options = $this->object->getOptions();

        return array_intersect_key($options, array_flip($value));
    }

    /**
     * Return the contextual human value.
     *
     * @return string
     */
    public function __print()
    {
        return implode(', ', $this->values());
    }
}
