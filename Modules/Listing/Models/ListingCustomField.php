<?php

namespace Modules\Listing\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;

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

    public static function uniqueNameFromLabel(string $label, ?self $record = null): string
    {
        $baseName = Str::slug($label, '_');
        $baseName = $baseName !== '' ? $baseName : 'custom_field';
        $name = $baseName;
        $counter = 1;

        while (static::query()
            ->where('name', $name)
            ->when($record, fn (Builder $query): Builder => $query->whereKeyNot($record->getKey()))
            ->exists()) {
            $name = "{$baseName}_{$counter}";
            $counter++;
        }

        return $name;
    }

    public static function upsertSeeded(Category $category, array $attributes): self
    {
        return static::query()->updateOrCreate(
            ['name' => (string) ($attributes['name'] ?? '')],
            [
                'label' => (string) ($attributes['label'] ?? ''),
                'type' => (string) ($attributes['type'] ?? self::TYPE_TEXT),
                'category_id' => (int) $category->getKey(),
                'placeholder' => $attributes['placeholder'] ?? null,
                'help_text' => $attributes['help_text'] ?? null,
                'options' => $attributes['options'] ?? null,
                'is_required' => (bool) ($attributes['is_required'] ?? false),
                'is_active' => (bool) ($attributes['is_active'] ?? true),
                'sort_order' => (int) ($attributes['sort_order'] ?? 0),
            ],
        );
    }

    public static function panelFieldDefinitions(?int $categoryId): array
    {
        return static::query()
            ->active()
            ->forCategory($categoryId)
            ->ordered()
            ->get(['name', 'label', 'type', 'is_required', 'placeholder', 'help_text', 'options'])
            ->map(fn (self $field): array => [
                'name' => (string) $field->name,
                'label' => (string) $field->label,
                'type' => (string) $field->type,
                'is_required' => (bool) $field->is_required,
                'placeholder' => $field->placeholder,
                'help_text' => $field->help_text,
                'options' => collect($field->options ?? [])
                    ->map(fn ($option): string => (string) $option)
                    ->values()
                    ->all(),
            ])
            ->all();
    }
}
