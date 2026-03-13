<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;

class UserWorkspaceSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            \Modules\Listing\Database\Seeders\ListingPanelDemoSeeder::class,
            \Modules\Favorite\Database\Seeders\FavoriteDemoSeeder::class,
            \Modules\Conversation\Database\Seeders\ConversationDemoSeeder::class,
            \Modules\Video\Database\Seeders\VideoDemoSeeder::class,
        ]);
    }
}
