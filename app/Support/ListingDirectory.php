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

        return Listing::summariesByIds($unique)
            ->mapWithKeys(static fn (Listing $listing): array => [
                (int) $listing->getKey() => [
                    'id' => (int) $listing->getKey(),
                    'title' => (string) $listing->getAttribute('title'),
                    'slug' => (string) $listing->getAttribute('slug'),
                    'price' => $listing->panelPriceLabel(),
                    'currency' => (string) $listing->getAttribute('currency'),
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
        return Listing::sellerIdOf($listingId);
    }

    public static function titleFor(int $listingId): string
    {
        return Listing::titleOf($listingId);
    }

    public static function exists(int $listingId): bool
    {
        return Listing::existsById($listingId);
    }
}
