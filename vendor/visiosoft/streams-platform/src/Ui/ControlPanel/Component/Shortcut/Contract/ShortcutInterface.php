<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut\Contract;

/**
 * Interface ShortcutInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface ShortcutInterface
{

    /**
     * Get the slug.
     *
     * @return null|string
     */
    public function getSlug();

    /**
     * Set the slug.
     *
     * @param $slug
     * @return $this
     */
    public function setSlug($slug);

    /**
     * Get the icon.
     *
     * @return null|string
     */
    public function getIcon();

    /**
     * Set the icon.
     *
     * @param $icon
     * @return $this
     */
    public function setIcon($icon);

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set the title.
     *
     * @param  string $title
     * @return $this
     */
    public function setTitle($title);

    /**
     * Get the label.
     *
     * @return string
     */
    public function getLabel();

    /**
     * Set the label.
     *
     * @param  string $label
     * @return $this
     */
    public function setLabel($label);

    /**
     * Get the class.
     *
     * @return string
     */
    public function getClass();

    /**
     * Set the class.
     *
     * @param $class
     * @return $this
     */
    public function setClass($class);
    
    /**
     * Get the highlighted flag.
     *
     * @return boolean
     */
    public function isHighlighted();

    /**
     * Set the highlighted flag.
     *
     * @param  boolean $active
     * @return $this
     */
    public function setHighlighted($highlighted);

    /**
     * Get the context.
     *
     * @return boolean
     */
    public function getContext();

    /**
     * Set the context flag.
     *
     * @param  boolean $active
     * @return $this
     */
    public function setContext($context);

    /**
     * Get the attributes.
     *
     * @return array
     */
    public function getAttributes();

    /**
     * Set the attributes.
     *
     * @param array $attributes
     */
    public function setAttributes(array $attributes);

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
     * Get the HREF attribute.
     *
     * @param  null $path
     * @return string
     */
    public function getHref($path = null);
}
