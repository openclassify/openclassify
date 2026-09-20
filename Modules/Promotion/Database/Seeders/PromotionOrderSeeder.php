<?php

declare(strict_types=1);

namespace Modules\Promotion\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Listing\Models\Listing;
use Modules\Promotion\Models\PromotionOrder;
use Modules\Promotion\Models\PromotionPlan;

class PromotionOrderSeeder extends Seeder
{
    public function run(): void
    {
        $plans = PromotionPlan::catalog();

        if ($plans->isEmpty()) {
            return;
        }

        $listings = Listing::query()
            ->active()
            ->whereNotNull('user_id')
            ->orderBy('id')
            ->limit(10)
            ->get(['id', 'user_id']);

        foreach ($listings as $index => $listing) {
            $plan = $plans[$index % $plans->count()];
            $expired = $index % 4 === 3;
            $startsAt = now()->subDays($expired ? 45 : ($index % 5) + 1);

            PromotionOrder::query()->create([
                'user_id' => (int) $listing->getAttribute('user_id'),
                'listing_id' => (int) $listing->getKey(),
                'plan_id' => (int) $plan->getKey(),
                'plan_name' => (string) $plan->getAttribute('name'),
                'amount' => (float) $plan->getAttribute('price'),
                'currency' => (string) $plan->getAttribute('currency'),
                'status' => $expired ? PromotionOrder::STATUS_EXPIRED : PromotionOrder::STATUS_ACTIVE,
                'starts_at' => $startsAt,
                'ends_at' => $startsAt->copy()->addDays((int) $plan->getAttribute('duration_days')),
                'created_at' => $startsAt,
                'updated_at' => $startsAt,
            ]);

            if (! $expired && (bool) $plan->getAttribute('grants_featured')) {
                $listing->forceFill(['is_featured' => true])->save();
            }
        }
    }
}
