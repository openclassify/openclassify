<?php

declare(strict_types=1);

namespace App\Support;

use Modules\Listing\Models\Listing;

final class ListingDirectory
{
    public static function resolve(array $listingIds): array
    {
        $unique = array_values(array_unique(array_map(static fn (int $id): int => $id, $listingIds)));

        if ($unique === []) {
            return [];
        }

        return Listing::query()
            ->whereIn('id', $unique)
            ->get(['id', 'title', 'slug', 'price', 'currency', 'user_id', 'status', 'images'])
            ->mapWithKeys(static fn (Listing $listing): array => [
                (int) $listing->getKey() => [
                    'id' => (int) $listing->getKey(),
                    'title' => (string) $listing->getAttribute('title'),
                    'slug' => (string) $listing->getAttribute('slug'),
                    'price' => $listing->panelPriceLabel(),
                    'image' => $listing->primaryImageUrl('thumb'),
                    'seller_id' => $listing->getAttribute('user_id') === null ? null : (int) $listing->getAttribute('user_id'),
                    'status' => $listing->statusValue(),
                ],
            ])
            ->all();
    }

    public static function find(int $listingId): ?array
    {
        return self::resolve([$listingId])[$listingId] ?? null;
    }

    public static function sellerIdFor(int $listingId): ?int
    {
        $value = Listing::query()->whereKey($listingId)->value('user_id');

        return $value === null ? null : (int) $value;
    }

    public static function titleFor(int $listingId): string
    {
        return (string) Listing::query()->whereKey($listingId)->value('title');
    }

    public static function exists(int $listingId): bool
    {
        return Listing::query()->whereKey($listingId)->exists();
    }
}
