<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Contract;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\SectionCollection;

/**
 * Interface SectionInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface SectionInterface
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
     * Get the matcher.
     *
     * @return null|string
     */
    public function getMatcher();

    /**
     * Set the matcher.
     *
     * @param $matcher
     * @return $this
     */
    public function setMatcher($matcher);

    /**
     * Get the permalink.
     *
     * @return null|string
     */
    public function getPermalink();

    /**
     * Set the permalink.
     *
     * @param $permalink
     * @return $this
     */
    public function setPermalink($permalink);

    /**
     * Get the description.
     *
     * @return null|string
     */
    public function getDescription();

    /**
     * Set the description.
     *
     * @param $description
     * @return $this
     */
    public function setDescription($description);

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
     * Get the parent.
     *
     * @return null|string
     */
    public function getParent();

    /**
     * Return if the section is
     * a sub-section or not.
     *
     * @return bool
     */
    public function isSubSection();

    /**
     * Set the parent.
     *
     * @param $parent
     * @return $this
     */
    public function setParent($parent);

    /**
     * Get the buttons.
     *
     * @return array|string
     */
    public function getButtons();

    /**
     * Set the buttons.
     *
     * @param array|string $buttons
     */
    public function setButtons($buttons);

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
     * Get the hidden flag.
     *
     * @return bool
     */
    public function isHidden();

    /**
     * Set the hidden flag.
     *
     * @param $hidden
     * @return $this
     */
    public function setHidden($hidden);

    /**
     * Get the HREF attribute.
     *
     * @param  null $path
     * @return string
     */
    public function getHref($path = null);

    /**
     * Return the child sections.
     *
     * @return SectionCollection
     */
    public function getChildren();

    /**
     * Return whether the section
     * has children or not.
     *
     * @return bool
     */
    public function hasChildren();
}
