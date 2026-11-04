<?php

declare(strict_types=1);

namespace Modules\Page\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    use SoftDeletes;

    public const PLACEMENT_FOOTER = 'footer';

    public const PLACEMENT_LEGAL = 'legal';

    public const PLACEMENT_HELP = 'help';

    private const NAVIGATION_CACHE_KEY = 'pages.navigation';

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

    protected static function booted(): void
    {
        $forget = static fn (): bool => Cache::forget(self::NAVIGATION_CACHE_KEY);

        static::saved($forget);
        static::deleted($forget);
        static::restored($forget);
    }

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

    public static function findPublished(string $slug): ?self
    {
        return static::query()->published()->where('slug', $slug)->first();
    }

    public static function navigationByPlacement(): array
    {
        return Cache::remember(self::NAVIGATION_CACHE_KEY, 3600, static fn (): array => static::query()
            ->published()
            ->whereIn('placement', static::placements())
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get(['id', 'title', 'slug', 'placement'])
            ->groupBy('placement')
            ->all());
    }

    public static function publishedSlugs(): Collection
    {
        return static::query()
            ->published()
            ->orderBy('sort_order')
            ->get(['slug', 'updated_at']);
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
