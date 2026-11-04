<?php

declare(strict_types=1);

namespace Modules\Review\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\LengthAwarePaginator;

class Review extends Model
{
    use SoftDeletes;

    public const MIN_RATING = 1;

    public const MAX_RATING = 5;

    protected $fillable = [
        'seller_id',
        'author_id',
        'listing_id',
        'rating',
        'title',
        'body',
        'is_approved',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
    ];

    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('is_approved', true);
    }

    public function scopeForSeller(Builder $query, int $sellerId): Builder
    {
        return $query->where('seller_id', $sellerId);
    }

    public function scopeForListing(Builder $query, ?int $listingId): Builder
    {
        return $listingId === null ? $query->whereNull('listing_id') : $query->where('listing_id', $listingId);
    }

    public function scopeWrittenBy(Builder $query, int $authorId): Builder
    {
        return $query->where('author_id', $authorId);
    }

    public static function summaryForSeller(int $sellerId): array
    {
        $row = static::query()
            ->approved()
            ->forSeller($sellerId)
            ->selectRaw('COUNT(*) as total, COALESCE(AVG(rating), 0) as average')
            ->first();

        $total = (int) ($row?->getAttribute('total') ?? 0);

        return [
            'total' => $total,
            'average' => $total > 0 ? round((float) ($row?->getAttribute('average') ?? 0), 1) : 0.0,
        ];
    }

    public static function distributionForSeller(int $sellerId): array
    {
        $counts = static::query()
            ->approved()
            ->forSeller($sellerId)
            ->selectRaw('rating, COUNT(*) as total')
            ->groupBy('rating')
            ->pluck('total', 'rating');

        $distribution = [];

        for ($score = self::MAX_RATING; $score >= self::MIN_RATING; $score--) {
            $distribution[$score] = (int) ($counts[$score] ?? 0);
        }

        return $distribution;
    }

    public static function paginateForSeller(int $sellerId, int $perPage = 10): LengthAwarePaginator
    {
        return static::query()
            ->approved()
            ->forSeller($sellerId)
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public static function receivedBySeller(int $sellerId, int $perPage = 10): LengthAwarePaginator
    {
        return static::query()
            ->forSeller($sellerId)
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public static function authorHasReviewed(int $authorId, int $sellerId, ?int $listingId): bool
    {
        return static::query()
            ->writtenBy($authorId)
            ->forSeller($sellerId)
            ->forListing($listingId)
            ->exists();
    }

    public static function record(int $sellerId, int $authorId, ?int $listingId, int $rating, ?string $title, ?string $body): self
    {
        $review = static::query()->make([
            'seller_id' => $sellerId,
            'author_id' => $authorId,
            'listing_id' => $listingId,
            'rating' => max(self::MIN_RATING, min(self::MAX_RATING, $rating)),
            'title' => $title,
            'body' => $body,
            'is_approved' => true,
        ]);

        $review->save();

        return $review;
    }

    public function authorId(): int
    {
        return (int) $this->getAttribute('author_id');
    }

    public function sellerId(): int
    {
        return (int) $this->getAttribute('seller_id');
    }

    public function listingId(): ?int
    {
        $value = $this->getAttribute('listing_id');

        return $value === null ? null : (int) $value;
    }

    public function ratingValue(): int
    {
        return (int) $this->getAttribute('rating');
    }
}
