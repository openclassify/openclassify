<?php namespace Anomaly\UsersModuleTest\Unit\User;

use Anomaly\UsersModule\Role\RoleCollection;
use Anomaly\UsersModule\Role\RoleModel;
use Anomaly\UsersModule\User\UserModel;
use Anomaly\UsersModuleTest\Concerns\UserData;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class UserModelTest
 *
 * @package Anomaly\UsersModuleTest
 */
class UserModelTest extends \TestCase
{

    use UserData, DatabaseTransactions;

    /**
     * Set up the user for testing.
     *
     * @return UserModel|null
     */
    protected function setUpUser()
    {
        $roleCollection = new RoleCollection();

        $roleCollection->add(factory(RoleModel::class)->create(['slug' => 'first_role']));
        $roleCollection->add(factory(RoleModel::class)->create(['slug' => 'second_role']));

        /** @var UserModel $user */
        return $this->getUserWithRoles($roleCollection);
    }

    /** @test */
    public function returnsTheUsersRolesCorrectly()
    {
        $user = $this->setUpUser();

        $this->assertTrue($user->hasRole('first_role'));
        $this->assertTrue($user->hasRole('second_role'));
    }
}
