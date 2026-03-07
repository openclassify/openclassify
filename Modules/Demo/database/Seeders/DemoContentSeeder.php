<?php

namespace Modules\Demo\Database\Seeders;

use Illuminate\Database\Seeder;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Modules\User\Database\Seeders\AuthUserSeeder::class,
            \Modules\Listing\Database\Seeders\ListingSeeder::class,
            \Modules\Listing\Database\Seeders\ListingPanelDemoSeeder::class,
            \Modules\Favorite\Database\Seeders\FavoriteDemoSeeder::class,
            \Modules\Conversation\Database\Seeders\ConversationDemoSeeder::class,
        ]);
    }
}
