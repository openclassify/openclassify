<?php namespace Anomaly\Streams\Platform\User\Contract;

/**
 * Interface UserInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface UserInterface
{

    /**
     * Get the ID.
     *
     * @return int
     */
    public function getId();

    /**
     * Return if an admin or not.
     *
     * @return bool
     */
    public function isAdmin();

    /**
     * Get the username.
     *
     * @return string
     */
    public function getUsername();

    /**
     * Return if the user has
     * a given permission.
     *
     * @param $permission
     * @return bool
     */
    public function hasPermission($permission);

    /**
     * Return if the user has any
     * of the given permissions.
     *
     * @param array $permissions
     * @return bool
     */
    public function hasAnyPermission(array $permissions);

    /**
     * Return if the user
     * has a given role.
     *
     * @param RoleInterface|string $role
     * @return bool
     */
    public function hasRole($role);

    /**
     * Return if the user has
     * any of the given roles.
     *
     * @param $roles
     * @return bool
     */
    public function hasAnyRole($roles);
}
