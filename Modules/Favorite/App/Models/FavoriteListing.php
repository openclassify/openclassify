<?php

declare(strict_types=1);

namespace Modules\Favorite\App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavoriteListing extends Pivot
{
    use SoftDeletes;

    protected $table = 'favorite_listings';

    public $incrementing = true;

    public static function countsForListings(array $listingIds): array
    {
        $unique = array_values(array_unique(array_map(static fn (int $id): int => $id, $listingIds)));

        if ($unique === []) {
            return [];
        }

        return static::query()
            ->whereIn('listing_id', $unique)
            ->selectRaw('listing_id, COUNT(*) as aggregate')
            ->groupBy('listing_id')
            ->pluck('aggregate', 'listing_id')
            ->mapWithKeys(static fn (mixed $count, mixed $listingId): array => [(int) $listingId => (int) $count])
            ->all();
    }

    public static function countForUser(int $userId): int
    {
        return static::query()->where('user_id', $userId)->count();
    }
}
