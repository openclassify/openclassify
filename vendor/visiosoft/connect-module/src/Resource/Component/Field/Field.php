<?php namespace Visiosoft\ConnectModule\Resource\Component\Field;

use Visiosoft\ConnectModule\Resource\Component\Field\Contract\FieldInterface;

/**
 * Class Field
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Field
 */
class Field implements FieldInterface
{

    /**
     * The field wrapper.
     *
     * @var null|string
     */
    protected $wrapper = null;

    /**
     * The field view.
     *
     * @var null
     */
    protected $view = null;

    /**
     * The field value.
     *
     * @var null|mixed
     */
    protected $value = null;

    /**
     * The field class.
     *
     * @var null|string
     */
    protected $class = null;

    /**
     * The field header.
     *
     * @var null|string
     */
    protected $header = null;

    /**
     * The field entry.
     *
     * @var null|mixed
     */
    protected $entry = null;

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
     * Get the field class.
     *
     * @return null|string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set the field class.
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
     * Get the field header.
     *
     * @return null|string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * Set the field header.
     *
     * @param $header
     * @return $this
     */
    public function setHeader($header)
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Get the field value.
     *
     * @return mixed|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the field value.
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
}
