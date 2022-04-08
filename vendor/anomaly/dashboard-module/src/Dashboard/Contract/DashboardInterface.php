<?php namespace Anomaly\DashboardModule\Dashboard\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\UsersModule\Role\RoleCollection;

/**
 * Interface DashboardInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface DashboardInterface extends EntryInterface
{

    /**
     * Get the active flag.
     *
     * @return bool
     */
    public function isActive();

    /**
     * Set the active flag.
     *
     * @param $active
     * @return $this
     */
    public function setActive($active);

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the allowed roles.
     *
     * @return RoleCollection
     */
    public function getAllowedRoles();

    /**
     * Get the related widgets.
     *
     * @return \Anomaly\Streams\Platform\Entry\EntryPresenter|mixed
     */
    public function getWidgets();

    /**
     * Return the widget relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function widgets();
}
