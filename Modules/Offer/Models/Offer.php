<?php

declare(strict_types=1);

namespace Modules\Offer\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;

class Offer extends Model
{
    use SoftDeletes;

    public const STATUS_PENDING = 'pending';

    public const STATUS_ACCEPTED = 'accepted';

    public const STATUS_DECLINED = 'declined';

    public const STATUS_WITHDRAWN = 'withdrawn';

    protected $fillable = [
        'listing_id',
        'buyer_id',
        'seller_id',
        'amount',
        'currency',
        'message',
        'status',
        'responded_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'responded_at' => 'datetime',
    ];

    public static function statuses(): array
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_ACCEPTED,
            self::STATUS_DECLINED,
            self::STATUS_WITHDRAWN,
        ];
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeForSeller(Builder $query, int $sellerId): Builder
    {
        return $query->where('seller_id', $sellerId);
    }

    public function scopeForBuyer(Builder $query, int $buyerId): Builder
    {
        return $query->where('buyer_id', $buyerId);
    }

    public function scopeForListing(Builder $query, int $listingId): Builder
    {
        return $query->where('listing_id', $listingId);
    }

    public function scopeWithStatus(Builder $query, string $status): Builder
    {
        return in_array($status, self::statuses(), true)
            ? $query->where('status', $status)
            : $query;
    }

    public static function place(int $listingId, int $buyerId, int $sellerId, float $amount, string $currency, ?string $message): self
    {
        static::query()
            ->forListing($listingId)
            ->forBuyer($buyerId)
            ->pending()
            ->update(['status' => self::STATUS_WITHDRAWN, 'responded_at' => now()]);

        $offer = static::query()->make([
            'listing_id' => $listingId,
            'buyer_id' => $buyerId,
            'seller_id' => $sellerId,
            'amount' => $amount,
            'currency' => $currency,
            'message' => $message,
            'status' => self::STATUS_PENDING,
        ]);

        $offer->save();

        return $offer;
    }

    public static function receivedBySeller(int $sellerId, string $status, int $perPage = 12): LengthAwarePaginator
    {
        return static::query()
            ->forSeller($sellerId)
            ->withStatus($status)
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public static function sentByBuyer(int $buyerId, int $perPage = 12): LengthAwarePaginator
    {
        return static::query()
            ->forBuyer($buyerId)
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public static function pendingCountForSeller(int $sellerId): int
    {
        return (int) static::query()->forSeller($sellerId)->pending()->count();
    }

    public static function statusCountsForSeller(int $sellerId): array
    {
        $counts = static::query()
            ->forSeller($sellerId)
            ->selectRaw('status, COUNT(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return [
            'all' => (int) $counts->sum(),
            self::STATUS_PENDING => (int) ($counts[self::STATUS_PENDING] ?? 0),
            self::STATUS_ACCEPTED => (int) ($counts[self::STATUS_ACCEPTED] ?? 0),
            self::STATUS_DECLINED => (int) ($counts[self::STATUS_DECLINED] ?? 0),
        ];
    }

    public static function highestPendingForListing(int $listingId): ?self
    {
        return static::query()
            ->forListing($listingId)
            ->pending()
            ->orderByDesc('amount')
            ->first();
    }

    public static function listingIdsWithOffersForSeller(int $sellerId): array
    {
        return static::query()
            ->forSeller($sellerId)
            ->pluck('listing_id')
            ->map(static fn (mixed $value): int => (int) $value)
            ->unique()
            ->values()
            ->all();
    }

    public function accept(): void
    {
        $this->forceFill([
            'status' => self::STATUS_ACCEPTED,
            'responded_at' => now(),
        ])->save();
    }

    public function decline(): void
    {
        $this->forceFill([
            'status' => self::STATUS_DECLINED,
            'responded_at' => now(),
        ])->save();
    }

    public function withdraw(): void
    {
        $this->forceFill([
            'status' => self::STATUS_WITHDRAWN,
            'responded_at' => now(),
        ])->save();
    }

    public function isPending(): bool
    {
        return $this->getAttribute('status') === self::STATUS_PENDING;
    }

    public function belongsToSeller(int $sellerId): bool
    {
        return (int) $this->getAttribute('seller_id') === $sellerId;
    }

    public function belongsToBuyer(int $buyerId): bool
    {
        return (int) $this->getAttribute('buyer_id') === $buyerId;
    }

    public function listingId(): int
    {
        return (int) $this->getAttribute('listing_id');
    }

    public function buyerId(): int
    {
        return (int) $this->getAttribute('buyer_id');
    }

    public function amountLabel(): string
    {
        return number_format((float) $this->getAttribute('amount'), 2).' '.(string) $this->getAttribute('currency');
    }

    public function statusTone(): string
    {
        return match ((string) $this->getAttribute('status')) {
            self::STATUS_ACCEPTED => 'positive',
            self::STATUS_DECLINED => 'critical',
            self::STATUS_WITHDRAWN => 'default',
            default => 'caution',
        };
    }
}
