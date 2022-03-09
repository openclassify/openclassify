<?php namespace Anomaly\DashboardModule\Dashboard;

use Anomaly\DashboardModule\Dashboard\Contract\DashboardInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DashboardCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DashboardCollection extends EntryCollection
{

    /**
     * Return only allowed dashboards.
     *
     * @return DashboardCollection
     */
    public function allowed()
    {
        /* @var UserInterface $user */
        if (!$user = app('auth')->user()) {
            return $this->make([]);
        }

        return $this->filter(
            function (DashboardInterface $dashboard) use ($user) {
                $roles = $dashboard->getAllowedRoles();

                return $roles->isEmpty() ?: $user->hasAnyRole($roles);
            }
        );
    }

    /**
     * Find a model in the collection by key.
     *
     * @param  mixed                               $key
     * @param  mixed                               $default
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($key, $default = null)
    {
        if ($key instanceof Model) {
            $key = $key->getKey();
        }

        return $this->first(
            function (DashboardInterface $model) use ($key) {
                return $model->getId() == $key || $model->getSlug() == $key;
            },
            $default
        );
    }
}
