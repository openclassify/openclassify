<?php

namespace Modules\Demo\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\User\App\Models\User;
use Spatie\Permission\Models\Role;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->updateOrCreate(
            ['email' => 'a@a.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('236330'),
                'status' => 'active',
            ],
        );

        $partner = User::query()->updateOrCreate(
            ['email' => 'b@b.com'],
            [
                'name' => 'Partner',
                'password' => Hash::make('36330'),
                'status' => 'active',
            ],
        );

        if (class_exists(Role::class)) {
            $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
            $partnerRole = Role::firstOrCreate(['name' => 'partner', 'guard_name' => 'web']);

            $admin->syncRoles([$adminRole->name]);
            $partner->syncRoles([$partnerRole->name]);
        }

        $this->call([
            \Modules\Listing\Database\Seeders\ListingSeeder::class,
            \Modules\Listing\Database\Seeders\ListingPanelDemoSeeder::class,
            \Modules\Favorite\Database\Seeders\FavoriteDemoSeeder::class,
            \Modules\Conversation\Database\Seeders\ConversationDemoSeeder::class,
        ]);
    }
}
