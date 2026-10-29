<?php

declare(strict_types=1);

namespace Modules\Favorite\App\Models;

use App\Support\FavoriteRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavoriteSeller extends Model
{
    use FavoriteRecord, SoftDeletes;

    protected const string TARGET_KEY = 'seller_id';

    protected $guarded = [];

    protected $casts = ['user_id' => 'integer', 'seller_id' => 'integer'];

    protected $table = 'favorite_sellers';

    public $incrementing = true;

    public static function countForUser(int $userId): int
    {
        return static::query()->where('user_id', $userId)->count();
    }
}
