<?php

namespace Anomaly\UsersModule\Role\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\UsersModule\User\UserCollection;

/**
 * Interface RoleInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface RoleInterface extends EntryInterface
{

    /**
     * Get the role's slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the role's name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the role's permissions.
     *
     * @return array
     */
    public function getPermissions();

    /**
     * Return if a role as access to a the permission.
     *
     * @param  string $permission
     * @return bool
     */
    public function hasPermission($permission);

    /**
     * Return whether a role has any of provided permission.
     *
     * @param array $permissions
     * @return bool
     */
    public function hasAnyPermission(array $permissions);

    /**
     * Add permissions to the role.
     *
     * @param array $permissions
     * @return $this
     */
    public function addPermissions(array $permissions);

    /**
     * Get the related users.
     *
     * @return UserCollection
     */
    public function getUsers();

    /**
     * Return the users relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users();
}
