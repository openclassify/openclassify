<?php
namespace Database\Seeders;

use Modules\User\App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'a@a.com'],
            ['name' => 'Admin', 'password' => Hash::make('236330'), 'status' => 'active']
        );

        $partner = User::updateOrCreate(
            ['email' => 'b@b.com'],
            ['name' => 'Partner', 'password' => Hash::make('36330'), 'status' => 'active']
        );

        if (class_exists(Role::class)) {
            $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
            $partnerRole = Role::firstOrCreate(['name' => 'partner', 'guard_name' => 'web']);

            $admin->syncRoles([$adminRole->name]);
            $partner->syncRoles([$partnerRole->name]);
        }

        $this->call([
            HomeSliderSettingsSeeder::class,
            \Modules\Location\Database\Seeders\LocationSeeder::class,
            \Modules\Category\Database\Seeders\CategorySeeder::class,
            \Modules\Listing\Database\Seeders\ListingCustomFieldSeeder::class,
            \Modules\Listing\Database\Seeders\ListingSeeder::class,
        ]);
    }
}
