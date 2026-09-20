<?php

declare(strict_types=1);

namespace Modules\Review\Database\Seeders;

use App\Support\ListingDirectory;
use Illuminate\Database\Seeder;
use Modules\Listing\Models\Listing;
use Modules\Review\Models\Review;
use Modules\User\App\Models\User;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::query()->orderBy('id')->pluck('id')->map(static fn (mixed $id): int => (int) $id)->all();

        if (count($userIds) < 2) {
            return;
        }

        $listingIds = Listing::query()
            ->whereNotNull('user_id')
            ->orderBy('id')
            ->limit(40)
            ->pluck('id')
            ->map(static fn (mixed $id): int => (int) $id)
            ->all();

        $bodies = $this->bodies();
        $index = 0;

        foreach ($listingIds as $listingId) {
            $sellerId = ListingDirectory::sellerIdFor($listingId);

            if ($sellerId === null) {
                continue;
            }

            $candidates = array_values(array_filter($userIds, static fn (int $id): bool => $id !== $sellerId));

            if ($candidates === []) {
                continue;
            }

            $authorId = $candidates[$index % count($candidates)];

            if (Review::authorHasReviewed($authorId, $listingId)) {
                $index++;

                continue;
            }

            $sample = $bodies[$index % count($bodies)];

            Review::query()->create([
                'seller_id' => $sellerId,
                'author_id' => $authorId,
                'listing_id' => $listingId,
                'rating' => $sample['rating'],
                'title' => $sample['title'],
                'body' => $sample['body'],
                'is_approved' => true,
                'created_at' => now()->subDays(($index % 45) + 1),
                'updated_at' => now()->subDays(($index % 45) + 1),
            ]);

            $index++;
        }
    }

    private function bodies(): array
    {
        return [
            ['rating' => 5, 'title' => 'Exactly as described', 'body' => 'The item matched the photos and the seller answered every question before we met. Smooth handover.'],
            ['rating' => 5, 'title' => 'Great communication', 'body' => 'Replied within minutes and was flexible about the meeting point. Would buy from again.'],
            ['rating' => 4, 'title' => 'Good deal', 'body' => 'Small scratch that was not visible in the photos, but the price was fair and the seller was upfront about the condition.'],
            ['rating' => 5, 'title' => 'Fast and easy', 'body' => 'Agreed on a price in the evening and collected the item the next morning. No surprises.'],
            ['rating' => 4, 'title' => 'Reliable seller', 'body' => 'Turned up on time and let me test the item before paying. Packaging could have been better.'],
            ['rating' => 3, 'title' => 'Took a while to arrange', 'body' => 'The item was fine but it took several days to settle on a time to meet.'],
            ['rating' => 5, 'title' => 'Highly recommended', 'body' => 'Honest description, clean item, and a friendly handover. This is how the marketplace should work.'],
            ['rating' => 4, 'title' => 'Happy with the purchase', 'body' => 'Works perfectly. The seller even included the original accessories that were not mentioned in the listing.'],
        ];
    }
}
