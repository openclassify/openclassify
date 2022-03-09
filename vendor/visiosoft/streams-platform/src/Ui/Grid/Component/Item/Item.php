<?php namespace Anomaly\Streams\Platform\Ui\Grid\Component\Item;

use Anomaly\Streams\Platform\Ui\Button\ButtonCollection;
use Anomaly\Streams\Platform\Ui\Grid\Component\Item\Contract\ItemInterface;

/**
 * Class Item
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Item implements ItemInterface
{

    /**
     * The item ID.
     *
     * @var int
     */
    protected $id = null;

    /**
     * @var null|string
     */
    protected $class = 'panel';

    /**
     * The item value.
     *
     * @var string
     */
    protected $value = null;

    /**
     * The item buttons.
     *
     * @var null|ButtonCollection
     */
    protected $buttons = null;

    /**
     * Get the ID.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the ID.
     *
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the class.
     *
     * @return null|string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the class.
     *
     * @param $class
     * @return $this
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the value.
     *
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the buttons.
     *
     * @return ButtonCollection
     */
    public function getButtons()
    {
        return $this->buttons;
    }

    /**
     * Set the buttons.
     *
     * @param  ButtonCollection $buttons
     * @return $this
     */
    public function setButtons(ButtonCollection $buttons)
    {
        $this->buttons = $buttons;

        return $this;
    }
}
