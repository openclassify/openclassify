<?php namespace Anomaly\Streams\Platform\Ui\Icon;

/**
 * Class Icon
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
/**
 * Class Icon
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Icon
{

    /**
     * The icon type.
     *
     * @var string
     */
    protected $type;

    /**
     * The icon class.
     *
     * @var string
     */
    protected $class;

    /**
     * Get the type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type.
     *
     * @param $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the class.
     *
     * @return string
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
     * Return the icon output.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->output();
    }

    /**
     * Return the icon output.
     *
     * @return string
     */
    public function output()
    {
        return '<i class="' . $this->type . ' ' . $this->class . '"></i>';
    }
}
