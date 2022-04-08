<?php namespace Anomaly\DashboardModule\Dashboard;

use Anomaly\DashboardModule\Dashboard\Contract\DashboardInterface;
use Anomaly\DashboardModule\Widget\WidgetCollection;
use Anomaly\DashboardModule\Widget\WidgetModel;
use Anomaly\Streams\Platform\Model\Dashboard\DashboardDashboardsEntryModel;
use Anomaly\UsersModule\Role\RoleCollection;

/**
 * Class DashboardModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DashboardModel extends DashboardDashboardsEntryModel implements DashboardInterface
{

    /**
     * The active flag.
     *
     * @var bool
     */
    protected $active = false;

    /**
     * Eager loaded relations.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    /**
     * The cascading relations.
     *
     * @var array
     */
    protected $cascades = [
        'widgets',
    ];

    /**
     * Get the active flag.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set the active flag.
     *
     * @param $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the allowed roles.
     *
     * @return RoleCollection
     */
    public function getAllowedRoles()
    {
        return $this->allowed_roles;
    }

    /**
     * Get the related widgets.
     *
     * @return WidgetCollection
     */
    public function getWidgets()
    {
        return $this->widgets;
    }

    /**
     * Return the widget relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function widgets()
    {
        return $this->hasMany(WidgetModel::class, 'dashboard_id');
    }
}
