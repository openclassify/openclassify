<?php

declare(strict_types=1);

namespace Modules\Favorite\App\Models;

use App\Support\FavoriteRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavoriteListing extends Model
{
    use FavoriteRecord, SoftDeletes;

    protected const string TARGET_KEY = 'listing_id';

    protected $guarded = [];

    protected $casts = ['user_id' => 'integer', 'listing_id' => 'integer'];

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
