<?php

declare(strict_types=1);

namespace Modules\Offer\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Listing\Models\Listing;
use Modules\Offer\Models\Offer;
use Modules\User\App\Models\User;

class OfferSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::query()->orderBy('id')->pluck('id')->map(static fn (mixed $id): int => (int) $id)->all();

        if (count($userIds) < 2) {
            return;
        }

        $listings = Listing::query()
            ->active()
            ->whereNotNull('user_id')
            ->whereNotNull('price')
            ->orderBy('id')
            ->limit(24)
            ->get(['id', 'user_id', 'price', 'currency']);

        $messages = $this->messages();
        $statuses = [Offer::STATUS_PENDING, Offer::STATUS_PENDING, Offer::STATUS_ACCEPTED, Offer::STATUS_DECLINED];
        $index = 0;

        foreach ($listings as $listing) {
            $sellerId = (int) $listing->getAttribute('user_id');
            $candidates = array_values(array_filter($userIds, static fn (int $id): bool => $id !== $sellerId));

            if ($candidates === []) {
                continue;
            }

            $price = (float) $listing->getAttribute('price');
            $ratios = [0.75, 0.85, 0.9];

            foreach (array_slice($ratios, 0, ($index % 2) + 1) as $step => $ratio) {
                $buyerId = $candidates[($index + $step) % count($candidates)];
                $status = $statuses[($index + $step) % count($statuses)];

                Offer::query()->create([
                    'listing_id' => (int) $listing->getKey(),
                    'buyer_id' => $buyerId,
                    'seller_id' => $sellerId,
                    'amount' => round($price * $ratio, 2),
                    'currency' => (string) $listing->getAttribute('currency'),
                    'message' => $messages[($index + $step) % count($messages)],
                    'status' => $status,
                    'responded_at' => $status === Offer::STATUS_PENDING ? null : now()->subDays($step + 1),
                    'created_at' => now()->subDays(($index % 20) + 1),
                    'updated_at' => now()->subDays(($index % 20) + 1),
                ]);
            }

            $index++;
        }
    }

    private function messages(): array
    {
        return [
            'Would you accept this if I collect today?',
            'Cash ready, can meet this evening near the centre.',
            'Interested. Is the price negotiable for a quick sale?',
            'Happy to pay the full amount if you can deliver.',
            'Can we agree on this? I can pick it up at the weekend.',
            null,
        ];
    }
}
