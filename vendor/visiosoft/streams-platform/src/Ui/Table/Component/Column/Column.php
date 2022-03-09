<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Column;

use Anomaly\Streams\Platform\Ui\Table\Component\Column\Contract\ColumnInterface;

/**
 * Class Column
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Column implements ColumnInterface
{

    /**
     * The column wrapper.
     *
     * @var null|string
     */
    protected $wrapper = null;

    /**
     * The column view.
     *
     * @var null
     */
    protected $view = null;

    /**
     * The column value.
     *
     * @var null|mixed
     */
    protected $value = null;

    /**
     * The column class.
     *
     * @var null|string
     */
    protected $class = null;

    /**
     * The column heading.
     *
     * @var null|string
     */
    protected $heading = null;

    /**
     * The column entry.
     *
     * @var null|mixed
     */
    protected $entry = null;

    /**
     * The column attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Get the wrapper.
     *
     * @return null|string
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * Set the wrap.
     *
     * @param $wrapper
     * @return $this
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;

        return $this;
    }

    /**
     * Get the view.
     *
     * @return null|string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set the view.
     *
     * @param $view
     * @return $this
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get the column class.
     *
     * @return null|string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the column class.
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
     * Get the column heading.
     *
     * @return null|string
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Set the column heading.
     *
     * @param $heading
     * @return $this
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * Get the column value.
     *
     * @return mixed|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the column value.
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
     * Get the entry.
     *
     * @return mixed|null
     */
    public function getEntry()
    {
        return $this->entry;
    }

    /**
     * Set the entry.
     *
     * @param $entry
     * @return $this
     */
    public function setEntry($entry)
    {
        $this->entry = $entry;

        return $this;
    }

    /**
     * Get the attributes.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Get the attributes.
     *
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }
}
