<?php

declare(strict_types=1);

namespace Modules\Promotion\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

class PromotionPlan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'currency',
        'duration_days',
        'grants_featured',
        'grants_urgent',
        'bump_count',
        'benefits',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'duration_days' => 'integer',
        'grants_featured' => 'boolean',
        'grants_urgent' => 'boolean',
        'bump_count' => 'integer',
        'benefits' => 'array',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public static function catalog(): Collection
    {
        return static::query()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('price')
            ->get();
    }

    public static function findActiveBySlug(string $slug): ?self
    {
        return static::query()->active()->where('slug', $slug)->first();
    }

    public function priceLabel(): string
    {
        $price = (float) $this->getAttribute('price');

        return $price <= 0.0
            ? __('promotion::messages.free')
            : number_format($price, 2).' '.(string) $this->getAttribute('currency');
    }

    public function benefitList(): array
    {
        $benefits = $this->getAttribute('benefits');

        return is_array($benefits) ? $benefits : [];
    }

    public function durationLabel(): string
    {
        return trans_choice('promotion::messages.duration_days', (int) $this->getAttribute('duration_days'), [
            'count' => (int) $this->getAttribute('duration_days'),
        ]);
    }
}
