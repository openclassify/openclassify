<?php namespace Anomaly\UsersModuleTest\Feature;

use Anomaly\UsersModuleTest\Concerns\UserData;

/**
 * Class LoginTest
 *
 * @package Anomaly\UsersModuleTest\Feature
 */
class LoginTest extends \TestCase
{

    use UserData;

//    /** @test */
//    public function canSeeLoginPage()
//    {
//        $this->visitRoute('anomaly.module.users::login')
//            ->see('Email')
//            ->see('Password');
//    }
//
    /** @test */
    public function cantAccessAdminPagesUnauthenticated()
    {
        $response = $this->get('admin/users');

        $response->assertStatus(302);
    }
//
//    /** @test */
//    public function cantAccessAdminPagesWithWrongPermissions()
//    {
//        $user = $this->getBasicUser();
//        $this->actingAs($user)
//            ->get('admin/users')
//            ->seeStatusCode(403);
//    }
}
