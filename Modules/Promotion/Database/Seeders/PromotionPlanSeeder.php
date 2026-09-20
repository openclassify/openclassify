<?php

declare(strict_types=1);

namespace Modules\Promotion\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Promotion\Models\PromotionPlan;

class PromotionPlanSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->records() as $record) {
            PromotionPlan::query()->updateOrCreate(['slug' => $record['slug']], $record);
        }
    }

    private function records(): array
    {
        $currency = (string) config('app.default_currency', 'USD');

        return [
            [
                'slug' => 'spotlight-7',
                'name' => 'Spotlight 7',
                'description' => 'Keep your listing at the top of its category for a week.',
                'price' => 4.90,
                'currency' => $currency,
                'duration_days' => 7,
                'grants_featured' => true,
                'grants_urgent' => false,
                'bump_count' => 1,
                'benefits' => [
                    'Featured badge on your listing',
                    'Top placement in category results',
                    'One automatic bump',
                ],
                'sort_order' => 1,
            ],
            [
                'slug' => 'spotlight-30',
                'name' => 'Spotlight 30',
                'description' => 'A full month of premium placement across the marketplace.',
                'price' => 14.90,
                'currency' => $currency,
                'duration_days' => 30,
                'grants_featured' => true,
                'grants_urgent' => false,
                'bump_count' => 4,
                'benefits' => [
                    'Featured badge on your listing',
                    'Homepage feature rotation',
                    'Four automatic bumps',
                    'Priority in search results',
                ],
                'sort_order' => 2,
            ],
            [
                'slug' => 'urgent-3',
                'name' => 'Urgent 3',
                'description' => 'Signal buyers that the item has to go quickly.',
                'price' => 2.90,
                'currency' => $currency,
                'duration_days' => 3,
                'grants_featured' => false,
                'grants_urgent' => true,
                'bump_count' => 1,
                'benefits' => [
                    'Urgent badge on your listing',
                    'Highlighted card in results',
                    'One automatic bump',
                ],
                'sort_order' => 3,
            ],
            [
                'slug' => 'starter',
                'name' => 'Starter',
                'description' => 'Give a new listing a small push at no cost.',
                'price' => 0,
                'currency' => $currency,
                'duration_days' => 2,
                'grants_featured' => false,
                'grants_urgent' => false,
                'bump_count' => 1,
                'benefits' => [
                    'One automatic bump',
                    'Included with every account',
                ],
                'sort_order' => 0,
            ],
        ];
    }
}
