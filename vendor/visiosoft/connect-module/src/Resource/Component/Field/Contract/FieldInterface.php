<?php namespace Visiosoft\ConnectModule\Resource\Component\Field\Contract;

/**
 * Interface FieldInterface
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Field\Contract
 */
interface FieldInterface
{

    /**
     * Get the wrapper.
     *
     * @return null|string
     */
    public function getWrapper();

    /**
     * Set the wrapper.
     *
     * @param $wrapper
     * @return $this
     */
    public function setWrapper($wrapper);

    /**
     * Get the view.
     *
     * @return null|string
     */
    public function getView();

    /**
     * Set the view.
     *
     * @param $view
     * @return $this
     */
    public function setView($view);

    /**
     * Set the field class.
     *
     * @param $class
     * @return $this
     */
    public function setClass($class);

    /**
     * Get the field class.
     *
     * @return null|string
     */
    public function getClass();

    /**
     * Set the field header.
     *
     * @param $header
     * @return $this
     */
    public function setHeader($header);

    /**
     * Get the field header.
     *
     * @return null|string
     */
    public function getHeader();

    /**
     * Set the field value.
     *
     * @param $value
     * @return $this
     */
    public function setValue($value);

    /**
     * Get the field value.
     *
     * @return mixed|null
     */
    public function getValue();

    /**
     * Get the entry.
     *
     * @return mixed|null
     */
    public function getEntry();

    /**
     * Set the entry.
     *
     * @param $entry
     * @return $this
     */
    public function setEntry($entry);
}
