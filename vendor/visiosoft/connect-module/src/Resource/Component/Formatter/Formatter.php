<?php namespace Visiosoft\ConnectModule\Resource\Component\Formatter;

use Visiosoft\ConnectModule\Resource\Component\Formatter\Contract\FormatterInterface;

/**
 * Class Formatter
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\Formatter
 */
class Formatter implements FormatterInterface
{

    /**
     * The formatter wrapper.
     *
     * @var null|string
     */
    protected $wrapper = null;

    /**
     * The formatter view.
     *
     * @var null
     */
    protected $view = null;

    /**
     * The field the formatter
     * applies to.
     *
     * @var null|string
     */
    protected $field = null;

    /**
     * The formatter format.
     *
     * @var null|mixed
     */
    protected $format = null;

    /**
     * The formatter output.
     *
     * @var null|string
     */
    protected $output = null;

    /**
     * The formatter entry.
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
     * Get the field.
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set the field.
     *
     * @param $field
     * @return $this
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get the formatter format.
     *
     * @return mixed|null
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set the formatter format.
     *
     * @param $format
     * @return $this
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Get the output.
     *
     * @return null|string
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Set the output.
     *
     * @param $output
     * @return $this
     */
    public function setOutput($output)
    {
        $this->output = $output;

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
