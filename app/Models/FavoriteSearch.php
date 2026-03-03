<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FavoriteSearch extends Model
{
    protected $fillable = [
        'user_id',
        'label',
        'search_term',
        'category_id',
        'filters',
        'signature',
    ];

    protected $casts = [
        'filters' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(\Modules\Category\Models\Category::class);
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
}
