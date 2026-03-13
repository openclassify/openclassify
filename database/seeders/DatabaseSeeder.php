<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Modules\User\Database\Seeders\AuthUserSeeder::class,
            \Modules\Location\Database\Seeders\LocationSeeder::class,
            \Modules\Category\Database\Seeders\CategorySeeder::class,
            \Modules\Listing\Database\Seeders\ListingCustomFieldSeeder::class,
            \Modules\Listing\Database\Seeders\ListingSeeder::class,
            \Modules\User\Database\Seeders\UserWorkspaceSeeder::class,
        ]);
    }
}
