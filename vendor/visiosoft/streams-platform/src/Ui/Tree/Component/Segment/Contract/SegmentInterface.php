<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Segment\Contract;

/**
 * Interface SegmentInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface SegmentInterface
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
     * Get the attributes.
     *
     * @return array
     */
    public function getAttributes();

    /**
     * Set the attributes.
     *
     * @param  array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes);

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
     * Set the segment class.
     *
     * @param $class
     * @return $this
     */
    public function setClass($class);

    /**
     * Get the segment class.
     *
     * @return null|string
     */
    public function getClass();

    /**
     * Set the segment value.
     *
     * @param $value
     * @return $this
     */
    public function setValue($value);

    /**
     * Get the segment value.
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
