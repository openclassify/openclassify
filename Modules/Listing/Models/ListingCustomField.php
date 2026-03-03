<?php

namespace Modules\Listing\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ListingCustomField extends Model
{
    public const TYPE_TEXT = 'text';
    public const TYPE_TEXTAREA = 'textarea';
    public const TYPE_NUMBER = 'number';
    public const TYPE_SELECT = 'select';
    public const TYPE_BOOLEAN = 'boolean';
    public const TYPE_DATE = 'date';

    protected $fillable = [
        'name',
        'label',
        'type',
        'category_id',
        'placeholder',
        'help_text',
        'options',
        'is_required',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(\Modules\Category\Models\Category::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeForCategory(Builder $query, ?int $categoryId): Builder
    {
        return $query->where(function (Builder $subQuery) use ($categoryId): void {
            $subQuery->whereNull('category_id');

            if ($categoryId) {
                $subQuery->orWhere('category_id', $categoryId);
            }
        });
    }

    public static function typeOptions(): array
    {
        return [
            self::TYPE_TEXT => 'Text',
            self::TYPE_TEXTAREA => 'Textarea',
            self::TYPE_NUMBER => 'Number',
            self::TYPE_SELECT => 'Select',
            self::TYPE_BOOLEAN => 'Boolean',
            self::TYPE_DATE => 'Date',
        ];
    }

    public function selectOptions(): array
    {
        $options = collect($this->options ?? [])
            ->map(fn ($option) => is_scalar($option) ? trim((string) $option) : null)
            ->filter(fn (?string $option): bool => filled($option))
            ->values()
            ->all();

        return collect($options)->mapWithKeys(fn (string $option): array => [$option => $option])->all();
    }
}
