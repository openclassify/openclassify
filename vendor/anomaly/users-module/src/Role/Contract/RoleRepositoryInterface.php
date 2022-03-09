<?php namespace Anomaly\UsersModule\Role\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\UsersModule\Role\RoleCollection;

/**
 * Interface RoleRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface RoleRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Return all but the admin role.
     *
     * @return RoleCollection
     */
    public function allButAdmin();

    /**
     * Return all but the admin and guest role.
     *
     * @return RoleCollection
     */
    public function allButAdminAndGuest();

    /**
     * Find a role by it's slug.
     *
     * @param $slug
     * @return null|RoleInterface
     */
    public function findBySlug($slug);

    /**
     * Find a role by a permission key.
     *
     * @param $permission
     * @return null|EntryCollection
     */
    public function findByPermission($permission);

    /**
     * Update permissions for a role.
     *
     * @param  RoleInterface $role
     * @param  array         $permissions
     * @return RoleInterface
     */
    public function updatePermissions(RoleInterface $role, array $permissions);
}
