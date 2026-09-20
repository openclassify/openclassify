<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Modules\Category\Database\Seeders\CategorySeeder;
use Modules\Conversation\Database\Seeders\ConversationDemoSeeder;
use Modules\Favorite\Database\Seeders\FavoriteDemoSeeder;
use Modules\Listing\Database\Seeders\ListingCustomFieldSeeder;
use Modules\Listing\Database\Seeders\ListingPanelDemoSeeder;
use Modules\Listing\Database\Seeders\ListingSeeder;
use Modules\Location\Database\Seeders\LocationSeeder;
use Modules\Notification\Database\Seeders\NotificationSeeder;
use Modules\Offer\Database\Seeders\OfferSeeder;
use Modules\Page\Database\Seeders\PageSeeder;
use Modules\Promotion\Database\Seeders\PromotionOrderSeeder;
use Modules\Promotion\Database\Seeders\PromotionPlanSeeder;
use Modules\Report\Database\Seeders\ReportSeeder;
use Modules\Review\Database\Seeders\ReviewSeeder;
use Modules\User\Database\Seeders\AuthUserSeeder;
use Modules\Video\Database\Seeders\VideoDemoSeeder;

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
            ListingPanelDemoSeeder::class,
            VideoDemoSeeder::class,
            FavoriteDemoSeeder::class,
            ConversationDemoSeeder::class,
            PageSeeder::class,
            PromotionPlanSeeder::class,
            PromotionOrderSeeder::class,
            OfferSeeder::class,
            ReviewSeeder::class,
            ReportSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
