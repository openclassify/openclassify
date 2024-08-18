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

    /** @test */
    public function canSeeLoginPage()
    {
        $this->get(env('APPLICATION_URL') . '/login')
            ->assertSee('Email')
            ->assertSee('Password');
    }

    /** @test */
    public function cantAccessAdminPagesUnauthenticated()
    {
        $response = $this->get(env('APPLICATION_URL') . '/admin/users');

        $response->assertStatus(302);
    }

    /** @test */
    public function cantAccessAdminPagesWithWrongPermissions()
    {
        $user = $this->getBasicUser();
        $this->actingAs($user)
            ->get(env('APPLICATION_URL') . '/admin/users')
            ->assertStatus(403);
    }
}
