<?php namespace Visiosoft\ConnectModule\Resource\Component\Formatter\Contract;

/**
 * Interface FormatterInterface
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Formatter\Contract
 */
interface FormatterInterface
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
     * Set the formatter field.
     *
     * @param $field
     * @return $this
     */
    public function setField($field);

    /**
     * Get the formatter field.
     *
     * @return mixed|null
     */
    public function getField();

    /**
     * Set the formatter format.
     *
     * @param $format
     * @return $this
     */
    public function setFormat($format);

    /**
     * Get the formatter format.
     *
     * @return mixed|null
     */
    public function getFormat();

    /**
     * Get the output.
     *
     * @return null|string
     */
    public function getOutput();

    /**
     * Set the output.
     *
     * @param $output
     * @return $this
     */
    public function setOutput($output);

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
