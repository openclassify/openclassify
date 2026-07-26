<?php

declare(strict_types=1);

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Conversation\Database\Seeders\ConversationDemoSeeder;
use Modules\Favorite\Database\Seeders\FavoriteDemoSeeder;
use Modules\Listing\Database\Seeders\ListingPanelDemoSeeder;
use Modules\Video\Database\Seeders\VideoDemoSeeder;

class UserWorkspaceSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ListingPanelDemoSeeder::class,
            FavoriteDemoSeeder::class,
            ConversationDemoSeeder::class,
            VideoDemoSeeder::class,
        ]);
    }
}
