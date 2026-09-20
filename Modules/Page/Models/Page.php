<?php

declare(strict_types=1);

namespace Modules\Page\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Page extends Model
{
    use SoftDeletes;

    public const PLACEMENT_FOOTER = 'footer';

    public const PLACEMENT_LEGAL = 'legal';

    public const PLACEMENT_HELP = 'help';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'meta_title',
        'meta_description',
        'placement',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function placements(): array
    {
        return [
            self::PLACEMENT_FOOTER,
            self::PLACEMENT_LEGAL,
            self::PLACEMENT_HELP,
        ];
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    public function scopeWithPlacement(Builder $query, string $placement): Builder
    {
        return $query->where('placement', $placement);
    }

    public static function findPublished(string $slug): ?self
    {
        return static::query()->published()->where('slug', $slug)->first();
    }

    public static function navigation(string $placement): Collection
    {
        return static::query()
            ->published()
            ->withPlacement($placement)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get(['id', 'title', 'slug']);
    }

    public static function publishedSlugs(): Collection
    {
        return static::query()
            ->published()
            ->orderBy('sort_order')
            ->get(['slug', 'updated_at']);
    }

    public static function uniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        $base = $base !== '' ? $base : 'page';
        $slug = $base;
        $suffix = 1;

        while (static::query()->where('slug', $slug)->exists()) {
            $suffix++;
            $slug = $base.'-'.$suffix;
        }

        return $slug;
    }

    public function metaTitleValue(): string
    {
        $meta = (string) $this->getAttribute('meta_title');

        return $meta !== '' ? $meta : (string) $this->getAttribute('title');
    }

    public function metaDescriptionValue(): string
    {
        $meta = (string) $this->getAttribute('meta_description');

        return $meta !== '' ? $meta : (string) $this->getAttribute('excerpt');
    }

    public function bodyParagraphs(): array
    {
        $body = (string) $this->getAttribute('body');

        return collect(preg_split('/\R{2,}/', $body) ?: [])
            ->map(static fn (string $block): string => trim($block))
            ->filter(static fn (string $block): bool => $block !== '')
            ->values()
            ->all();
    }
}
