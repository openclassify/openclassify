<?php

declare(strict_types=1);

namespace Modules\Promotion\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class PromotionOrder extends Model
{
    use SoftDeletes;

    public const STATUS_ACTIVE = 'active';

    public const STATUS_EXPIRED = 'expired';

    public const STATUS_CANCELLED = 'cancelled';

    protected $fillable = [
        'user_id',
        'listing_id',
        'plan_id',
        'plan_name',
        'amount',
        'currency',
        'status',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('status', self::STATUS_ACTIVE)
            ->where(fn (Builder $inner): Builder => $inner->whereNull('ends_at')->orWhere('ends_at', '>=', now()));
    }

    public function scopeForUser(Builder $query, int $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForListing(Builder $query, int $listingId): Builder
    {
        return $query->where('listing_id', $listingId);
    }

    public static function open(PromotionPlan $plan, int $userId, int $listingId): self
    {
        static::query()
            ->forListing($listingId)
            ->active()
            ->update(['status' => self::STATUS_CANCELLED]);

        $order = static::query()->make([
            'user_id' => $userId,
            'listing_id' => $listingId,
            'plan_id' => $plan->getKey(),
            'plan_name' => (string) $plan->getAttribute('name'),
            'amount' => (float) $plan->getAttribute('price'),
            'currency' => (string) $plan->getAttribute('currency'),
            'status' => self::STATUS_ACTIVE,
            'starts_at' => now(),
            'ends_at' => now()->addDays((int) $plan->getAttribute('duration_days')),
        ]);

        $order->save();

        return $order;
    }

    public static function activeListingIds(): array
    {
        return static::query()
            ->active()
            ->pluck('listing_id')
            ->map(static fn (mixed $value): int => (int) $value)
            ->unique()
            ->values()
            ->all();
    }

    public static function activeForListing(int $listingId): ?self
    {
        return static::query()->forListing($listingId)->active()->latest('id')->first();
    }

    public static function paginateForUser(int $userId, int $perPage = 12): LengthAwarePaginator
    {
        return static::query()
            ->forUser($userId)
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public static function activeCountForUser(int $userId): int
    {
        return (int) static::query()->forUser($userId)->active()->count();
    }

    public static function expireOutdated(): int
    {
        return static::query()
            ->where('status', self::STATUS_ACTIVE)
            ->whereNotNull('ends_at')
            ->where('ends_at', '<', now())
            ->update(['status' => self::STATUS_EXPIRED]);
    }

    public function listingId(): int
    {
        return (int) $this->getAttribute('listing_id');
    }

    public function isRunning(): bool
    {
        if ((string) $this->getAttribute('status') !== self::STATUS_ACTIVE) {
            return false;
        }

        $endsAt = $this->getAttribute('ends_at');

        return ! $endsAt instanceof Carbon || $endsAt->isFuture();
    }

    public function remainingDays(): int
    {
        $endsAt = $this->getAttribute('ends_at');

        if (! $endsAt instanceof Carbon) {
            return 0;
        }

        return max(0, (int) now()->startOfDay()->diffInDays($endsAt->startOfDay(), false));
    }

    public function amountLabel(): string
    {
        return number_format((float) $this->getAttribute('amount'), 2).' '.(string) $this->getAttribute('currency');
    }
}
