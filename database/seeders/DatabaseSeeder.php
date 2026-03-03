<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@openclassify.com',
            'password' => Hash::make('password'),
        ]);

        $partner = \App\Models\User::factory()->create([
            'name' => 'Partner User',
            'email' => 'partner@openclassify.com',
            'password' => Hash::make('password'),
        ]);

        if (class_exists(\Spatie\Permission\Models\Role::class)) {
            $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
            \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'partner', 'guard_name' => 'web']);
            $admin->assignRole($adminRole);
        }

        $this->call([
            \Modules\Location\Database\Seeders\LocationSeeder::class,
            \Modules\Category\Database\Seeders\CategorySeeder::class,
            \Modules\Listing\Database\Seeders\ListingSeeder::class,
        ]);
    }
}
