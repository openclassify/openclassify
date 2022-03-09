<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Contract;

/**
 * Interface NavigationLinkInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
/**
 * Interface NavigationLinkInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface NavigationLinkInterface
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
     * Get the active flag.
     *
     * @return boolean
     */
    public function isActive();

    /**
     * Set the active flag.
     *
     * @param  boolean $active
     * @return $this
     */
    public function setActive($active);

    /**
     * Get the favorite flag.
     *
     * @return boolean
     */
    public function isFavorite();

    /**
     * Set the favorite flag.
     *
     * @param boolean $favorite
     */
    public function setFavorite($favorite);

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
     * Get the breadcrumb.
     *
     * @return null|string
     */
    public function getBreadcrumb();

    /**
     * Set the breadcrumb.
     *
     * @param $breadcrumb
     * @return $this
     */
    public function setBreadcrumb($breadcrumb);

    /**
     * Get the HREF attribute.
     *
     * @param  null   $path
     * @return string
     */
    public function getHref($path = null);
}
