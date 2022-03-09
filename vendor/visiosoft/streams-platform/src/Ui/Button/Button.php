<?php namespace Anomaly\Streams\Platform\Ui\Button;

use Anomaly\Streams\Platform\Ui\Button\Contract\ButtonInterface;

/**
 * Class Button
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class Button implements ButtonInterface
{

    /**
     * The action tag.
     *
     * @var string
     */
    protected $tag = 'a';

    /**
     * The button URL.
     *
     * @var null|string
     */
    protected $url = null;

    /**
     * The button text.
     *
     * @var null|string
     */
    protected $text = null;

    /**
     * The button icon.
     *
     * @var null|string
     */
    protected $icon = null;

    /**
     * The button class.
     *
     * @var null|string
     */
    protected $class = null;

    /**
     * The button type.
     *
     * @var null|string
     */
    protected $type = 'default';

    /**
     * The button size.
     *
     * @var string
     */
    protected $size = 'md';

    /**
     * The required permission.
     *
     * @var null|string
     */
    protected $permission = null;

    /**
     * The disabled flag.
     *
     * @var bool
     */
    protected $disabled = false;

    /**
     * The enabled flag.
     *
     * @var bool
     */
    protected $enabled = true;

    /**
     * The button's attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The button's dropdown.
     *
     * @var array
     */
    protected $dropdown = [];

    /**
     * The dropup flag.
     *
     * @var string
     */
    protected $dropup = false;

    /**
     * The dropdown position.
     *
     * @var string
     */
    protected $position = 'left';

    /**
     * The parent dropdown.
     *
     * @var null|string
     */
    protected $parent = null;

    /**
     * The entry object.
     *
     * @var null|mixed
     */
    protected $entry = null;

    /**
     * Return whether the button is a dropdown or not.
     *
     * @return bool
     */
    public function isDropdown()
    {
        return (bool)$this->getDropdown();
    }

    /**
     * Get the dropdown.
     *
     * @return array
     */
    public function getDropdown()
    {
        return $this->dropdown;
    }

    /**
     * Set the dropdown.
     *
     * @param  array $dropdown
     * @return $this
     */
    public function setDropdown(array $dropdown)
    {
        $this->dropdown = $dropdown;

        return $this;
    }

    /**
     * Return whether the button is a dropup or not.
     *
     * @return bool
     */
    public function isDropup()
    {
        return $this->dropup;
    }

    /**
     * Set dropup flag.
     *
     * @param  $dropup
     * @return $this
     */
    public function setDropup($dropup)
    {
        $this->dropup = $dropup;

        return $this;
    }

    /**
     * Get the dropdown position.
     *
     * @return array
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the dropdown position.
     *
     * @param  array $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get the parent.
     *
     * @return string|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent.
     *
     * @param $parent
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

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
     * Set the attributes.
     *
     * @param  array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Get the disabled flag.
     *
     * @return bool
     */
    public function isDisabled()
    {
        return $this->disabled;
    }

    /**
     * Set the disabled flag.
     *
     * @param $disabled
     * @return $this
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Set the enabled flag.
     *
     * @param $enabled
     * @return $this
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
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
     * Set the table.
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
     * Get the icon.
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the icon.
     *
     * @param  string $icon
     * @return $this
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

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
     * Get the button size.
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set the button size.
     *
     * @param $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the permission.
     *
     * @return null|string
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set the permission.
     *
     * @param $permission
     * @return $this
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get the button type.
     *
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the button type.
     *
     * @param  string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the button text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set the button text.
     *
     * @param  string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the button URL.
     *
     * @return null|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set the URL.
     *
     * @param $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get the button tag.
     *
     * @return null|string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set the tag.
     *
     * @param $tag
     * @return $this
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }
}
