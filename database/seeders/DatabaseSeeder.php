<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Modules\Category\Database\Seeders\CategorySeeder;
use Modules\Listing\Database\Seeders\ListingCustomFieldSeeder;
use Modules\Listing\Database\Seeders\ListingSeeder;
use Modules\Location\Database\Seeders\LocationSeeder;
use Modules\User\Database\Seeders\AuthUserSeeder;
use Modules\User\Database\Seeders\UserWorkspaceSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        if (Schema::hasTable('settings')) {
            Artisan::call('migrate', [
                '--path' => 'database/settings',
                '--force' => true,
            ]);
        }

        $this->call([
            AuthUserSeeder::class,
            LocationSeeder::class,
            CategorySeeder::class,
            ListingCustomFieldSeeder::class,
            ListingSeeder::class,
            UserWorkspaceSeeder::class,
        ]);
    }
}
