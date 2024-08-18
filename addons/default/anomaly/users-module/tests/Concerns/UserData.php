<?php namespace Anomaly\UsersModuleTest\Concerns;

use Anomaly\UsersModule\Role\RoleCollection;
use Anomaly\UsersModule\Role\RoleModel;
use Anomaly\UsersModule\User\UserModel;

/**
 * Class UserWithRoles
 *
 * @package Anomaly\UsersModuleTest\Concerns
 */
trait UserData
{

    /**
     * Get a single user with several roles.
     *
     * @param RoleCollection|null $roles
     * @return null|UserModel
     */
    public function getUserWithRoles(RoleCollection $roles = null)
    {

        /** @var UserModel $user */
        $user = UserModel::factory()->create();

        if (is_null($roles)) {
            $user->attachRole(
                RoleModel::factory()->create(['permissions' => 'anomaly.module.test::test.permission1'])
            );
            $user->attachRole(
                RoleModel::factory()->create(['permissions' => 'anomaly.module.test::test.permission2'])
            );
        } else {
            $roles->each(
                function ($role) use ($user) {
                    $user->attachRole($role);
                }
            );
        }

        return $user->fresh();
    }

    /**
     * @param array $attributes
     * @return UserModel
     */
    public function getBasicUser($attributes = []): UserModel
    {
        return UserModel::factory()->create($attributes);
    }

}
