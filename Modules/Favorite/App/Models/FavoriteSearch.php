<?php

namespace Modules\Favorite\App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Models\Category;
use Modules\User\App\Models\User;

class FavoriteSearch extends Model
{
    protected $fillable = ['user_id', 'label', 'search_term', 'category_id', 'filters', 'signature'];

    protected $casts = ['filters' => 'array'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function normalizeFilters(array $filters): array
    {
        return collect($filters)
            ->map(fn ($value) => is_string($value) ? trim($value) : $value)
            ->filter(fn ($value) => $value !== null && $value !== '' && $value !== [])
            ->sortKeys()
            ->all();
    }

    public static function signatureFor(array $filters): string
    {
        $normalized = static::normalizeFilters($filters);
        $payload = json_encode($normalized);

        return hash('sha256', is_string($payload) ? $payload : '');
    }

    public static function labelFor(array $filters, ?string $categoryName = null): string
    {
        $labelParts = [];

        if (! empty($filters['search'])) {
            $labelParts[] = '"'.$filters['search'].'"';
        }

        if (filled($categoryName)) {
            $labelParts[] = $categoryName;
        }

        return $labelParts !== [] ? implode(' · ', $labelParts) : 'Filtered search';
    }

    public static function isSavedForUser(User $user, array $filters): bool
    {
        $normalized = static::normalizeFilters($filters);

        if ($normalized === []) {
            return false;
        }

        return $user->favoriteSearches()
            ->where('signature', static::signatureFor($normalized))
            ->exists();
    }

    public static function storeForUser(User $user, array $filters): self
    {
        $normalized = static::normalizeFilters($filters);
        $signature = static::signatureFor($normalized);
        $categoryName = isset($normalized['category'])
            ? Category::query()->whereKey($normalized['category'])->value('name')
            : null;

        return $user->favoriteSearches()->firstOrCreate(
            ['signature' => $signature],
            [
                'label' => static::labelFor($normalized, is_string($categoryName) ? $categoryName : null),
                'search_term' => $normalized['search'] ?? null,
                'category_id' => $normalized['category'] ?? null,
                'filters' => $normalized,
            ]
        );
    }
}
