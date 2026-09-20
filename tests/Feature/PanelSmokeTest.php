<?php

declare(strict_types=1);

namespace Tests\Feature;

use Modules\User\App\Models\User;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PanelSmokeTest extends TestCase
{
    public static function panelRoutes(): array
    {
        return [
            'dashboard' => ['/panel'],
            'listings' => ['/panel/my-listings'],
            'offers' => ['/panel/offers'],
            'promotions' => ['/panel/promotions'],
            'notifications' => ['/panel/notifications'],
            'inbox' => ['/panel/inbox'],
            'profile' => ['/panel/my-profile'],
            'videos' => ['/panel/videos'],
            'create' => ['/panel/create-listing'],
            'favorites' => ['/favorites'],
        ];
    }

    public static function publicRoutes(): array
    {
        return [
            'home' => ['/'],
            'listings' => ['/listings'],
            'categories' => ['/categories'],
            'promotions' => ['/promotions'],
            'about' => ['/pages/about'],
            'sitemap' => ['/sitemap.xml'],
            'robots' => ['/robots.txt'],
            'login' => ['/login'],
            'register' => ['/register'],
        ];
    }

    #[DataProvider('panelRoutes')]
    public function test_panel_route_renders(string $uri): void
    {
        $user = User::query()->orderBy('id')->firstOrFail();

        $this->actingAs($user)->get($uri)->assertSuccessful();
    }

    #[DataProvider('publicRoutes')]
    public function test_public_route_renders(string $uri): void
    {
        $this->get($uri)->assertSuccessful();
    }

    public static function adminRoutes(): array
    {
        return [
            'reviews' => ['/admin/reviews'],
            'reports' => ['/admin/reports'],
            'offers' => ['/admin/offers'],
            'pages' => ['/admin/pages'],
            'promotion plans' => ['/admin/promotion-plans'],
            'notifications' => ['/admin/user-notifications'],
            'listings' => ['/admin/listings'],
            'categories' => ['/admin/categories'],
            'users' => ['/admin/users'],
        ];
    }

    #[DataProvider('adminRoutes')]
    public function test_admin_route_renders(string $uri): void
    {
        $admin = User::query()->where('email', 'a@a.com')->firstOrFail();

        $this->actingAs($admin)->get($uri)->assertSuccessful();
    }

    public function test_seller_storefront_renders(): void
    {
        $user = User::query()->orderBy('id')->firstOrFail();

        $this->get('/sellers/'.$user->getKey())->assertSuccessful();
    }
}
