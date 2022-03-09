<?php namespace Anomaly\UsersModule\Role;

use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\UsersModule\Role\Contract\RoleInterface;

/**
 * Class RoleCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class RoleCollection extends EntryCollection
{

    /**
     * Return all permissions.
     *
     * @return array
     */
    public function permissions()
    {
        return $this->map(
            function (RoleInterface $role) {
                return $role->getPermissions();
            }
        )->flatten()->all();
    }

    /**
     * Return if a role as access to a the permission.
     *
     * @param  string $permission
     * @return RoleCollection
     */
    public function hasPermission($permission)
    {
        return $this->filter(
            function (RoleInterface $role) use ($permission) {
                return $role->hasPermission($permission);
            }
        );
    }

    /**
     * Return if the role exists or not.
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return (bool)$this->first(
            function ($item) use ($role) {

                /* @var RoleInterface $item */
                return $item->getSlug() == $role;
            }
        );
    }
}
