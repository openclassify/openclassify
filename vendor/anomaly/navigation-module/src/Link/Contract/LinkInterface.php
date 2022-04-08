<?php namespace Anomaly\NavigationModule\Link\Contract;

use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\NavigationModule\Link\Type\LinkTypeExtension;
use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Interface LinkInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface LinkInterface extends EntryInterface
{

    /**
     * Return the host.
     *
     * @return string
     */
    public function host();

    /**
     * Return the URL path.
     *
     * @return string
     */
    public function path();

    /**
     * Get the URL.
     *
     * @return string
     */
    public function getUrl();

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Get the type.
     *
     * @return LinkTypeExtension
     */
    public function getType();

    /**
     * Get the related entry.
     *
     * @return EntryInterface
     */
    public function getEntry();

    /**
     * Get the enabled flag.
     *
     * @return EntryInterface
     */
    public function isEnabled();

    /**
     * Get the link target.
     *
     * @return string
     */
    public function getTarget();

    /**
     * Get the related allowed roles.
     *
     * @return EntryCollection
     */
    public function getAllowedRoles();

    /**
     * et the active flag.
     *
     * @param $true
     * @return $this
     */
    public function setActive($active);

    /**
     * Return the active flag.
     *
     * @return bool
     */
    public function isActive();

    /**
     * Set the current flag.
     *
     * @param $true
     * @return $this
     */
    public function setCurrent($current);

    /**
     * Return the current flag.
     *
     * @return bool
     */
    public function isCurrent();

    /**
     * Get the related parent.
     *
     * @return null|LinkInterface
     */
    public function getParent();

    /**
     * Get the parent ID.
     *
     * @return null|int
     */
    public function getParentId();

    /**
     * Set the parent ID.
     *
     * @param $id
     * @return $this
     */
    public function setParentId($id);

    /**
     * Get the menu.
     *
     * @return MenuInterface
     */
    public function getMenu();

    /**
     * Get the menu slug.
     *
     * @return string
     */
    public function getMenuSlug();

    /**
     * Get the related child links.
     *
     * @return LinkCollection
     */
    public function getChildren();

    /**
     * Return the child links relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children();

    /**
     * Get the HTML class.
     *
     * @return string
     */
    public function getClass();
}
