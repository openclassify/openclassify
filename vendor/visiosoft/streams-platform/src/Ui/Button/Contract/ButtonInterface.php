<?php namespace Anomaly\Streams\Platform\Ui\Button\Contract;

/**
 * Interface ButtonInterface
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
interface ButtonInterface
{

    /**
     * Set the dropdown.
     *
     * @param  array $dropdown
     * @return $this
     */
    public function setDropdown(array $dropdown);

    /**
     * Get the dropdown.
     *
     * @return array
     */
    public function getDropdown();

    /**
     * Return whether the button is a dropup or not.
     *
     * @return bool
     */
    public function isDropup();

    /**
     * Set the dropdown position.
     *
     * @param  array $position
     * @return $this
     */
    public function setPosition($position);

    /**
     * Get the dropdown position.
     *
     * @return array
     */
    public function getPosition();

    /**
     * Set the parent.
     *
     * @param $parent
     * @return $this
     */
    public function setParent($parent);

    /**
     * Get the parent.
     *
     * @return string|null
     */
    public function getParent();

    /**
     * Return whether the button is a dropdown or not.
     *
     * @return bool
     */
    public function isDropdown();

    /**
     * Set the attributes.
     *
     * @param  array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes);

    /**
     * Get attributes.
     *
     * @return mixed
     */
    public function getAttributes();

    /**
     * Set the enabled flag.
     *
     * @param $enabled
     * @return mixed
     */
    public function setEnabled($enabled);

    /**
     * Get the enabled flag.
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Get the entry.
     *
     * @return mixed|null
     */
    public function getEntry();

    /**
     * Set the table.
     *
     * @param $entry
     * @return $this
     */
    public function setEntry($entry);

    /**
     * Set the icon.
     *
     * @param  $icon
     * @return mixed
     */
    public function setIcon($icon);

    /**
     * Get the icon.
     *
     * @return mixed
     */
    public function getIcon();

    /**
     * Set the text.
     *
     * @param  $text
     * @return mixed
     */
    public function setText($text);

    /**
     * Get the text.
     *
     * @return mixed
     */
    public function getText();

    /**
     * Set the button type.
     *
     * @param  string $type
     * @return $this
     */
    public function setType($type);

    /**
     * Get the button type.
     *
     * @return string
     */
    public function getType();

    /**
     * Set the button size.
     *
     * @param $size
     * @return $this
     */
    public function setSize($size);

    /**
     * Get the button size.
     *
     * @return string
     */
    public function getSize();

    /**
     * Get the permission.
     *
     * @return null|string
     */
    public function getPermission();

    /**
     * Set the permission.
     *
     * @param $permission
     * @return $this
     */
    public function setPermission($permission);

    /**
     * Set the URL.
     *
     * @param $url
     * @return $this
     */
    public function setUrl($url);

    /**
     * Get the URL.
     *
     * @return null|string
     */
    public function getUrl();
}
