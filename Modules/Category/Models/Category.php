<?php

namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Modules\Listing\Models\Listing;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;

    private const ICON_PATHS = [
        'car' => 'img/category/car.png',
        'education' => 'img/category/education.png',
        'electronics' => 'img/category/electronics.png',
        'football' => 'img/category/sports.png',
        'home' => 'img/category/home_garden.png',
        'home-garden' => 'img/category/home_garden.png',
        'home_garden' => 'img/category/home_garden.png',
        'home-tools' => 'img/category/home_tools.png',
        'home_tools' => 'img/category/home_tools.png',
        'laptop' => 'img/category/laptop.png',
        'mobile' => 'img/category/phone.png',
        'pet' => 'img/category/pet.png',
        'phone' => 'img/category/phone.png',
        'sports' => 'img/category/sports.png',
    ];

    protected $fillable = ['name', 'slug', 'description', 'icon', 'parent_id', 'level', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function listings(): HasMany
    {
        return $this->hasMany(\Modules\Listing\Models\Listing::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function scopeForAdminHierarchy(Builder $query, array $expandedParentIds = []): Builder
    {
        $expandedParentIds = collect($expandedParentIds)
            ->map(fn ($id): int => (int) $id)
            ->filter()
            ->unique()
            ->values()
            ->all();

        return $query
            ->select('categories.*')
            ->leftJoin('categories as parent_categories', 'categories.parent_id', '=', 'parent_categories.id')
            ->with(['parent:id,name'])
            ->withCount(['children', 'listings'])
            ->where(function (Builder $nestedQuery) use ($expandedParentIds): void {
                $nestedQuery->whereNull('categories.parent_id');

                if ($expandedParentIds !== []) {
                    $nestedQuery->orWhereIn('categories.parent_id', $expandedParentIds);
                }
            })
            ->orderByRaw('COALESCE(parent_categories.sort_order, categories.sort_order)')
            ->orderByRaw('COALESCE(parent_categories.name, categories.name)')
            ->orderByRaw('CASE WHEN categories.parent_id IS NULL THEN 0 ELSE 1 END')
            ->orderBy('categories.sort_order')
            ->orderBy('categories.name');
    }

    public static function filterOptions(): Collection
    {
        return static::query()
            ->active()
            ->ordered()
            ->get(['id', 'name']);
    }

    public static function activeIdNameOptions(): array
    {
        return static::query()
            ->active()
            ->ordered()
            ->pluck('name', 'id')
            ->all();
    }

    public static function activeCount(): int
    {
        return (int) static::query()
            ->active()
            ->count();
    }

    public static function homeParentCategories(int $limit = 8): Collection
    {
        return static::query()
            ->active()
            ->whereNull('parent_id')
            ->ordered()
            ->limit($limit)
            ->get();
    }

    public static function headerNavigationItems(int $limit = 8): array
    {
        return static::query()
            ->active()
            ->whereNull('parent_id')
            ->ordered()
            ->limit($limit)
            ->get(['id', 'name', 'icon'])
            ->map(fn (self $category): array => [
                'id' => (int) $category->id,
                'name' => (string) $category->name,
                'icon_url' => $category->iconUrl(),
            ])
            ->all();
    }

    public static function activeAiCatalog(): Collection
    {
        return static::query()
            ->active()
            ->ordered()
            ->get(['id', 'name', 'parent_id']);
    }

    public static function panelQuickCatalog(): array
    {
        $all = static::query()
            ->active()
            ->ordered()
            ->get(['id', 'name', 'parent_id', 'icon']);

        $childrenCount = static::query()
            ->active()
            ->selectRaw('parent_id, count(*) as aggregate')
            ->whereNotNull('parent_id')
            ->groupBy('parent_id')
            ->pluck('aggregate', 'parent_id');

        return $all
            ->map(fn (self $category): array => [
                'id' => (int) $category->id,
                'name' => (string) $category->name,
                'parent_id' => $category->parent_id ? (int) $category->parent_id : null,
                'icon' => $category->icon,
                'has_children' => ((int) ($childrenCount[$category->id] ?? 0)) > 0,
            ])
            ->all();
    }

    public static function rootIdNameOptions(): array
    {
        return static::query()
            ->active()
            ->whereNull('parent_id')
            ->ordered()
            ->pluck('name', 'id')
            ->all();
    }

    public static function themePills(int $limit = 8): Collection
    {
        return static::query()
            ->active()
            ->ordered()
            ->limit($limit)
            ->get(['id', 'name', 'slug']);
    }

    public static function seedableListingFieldCategories(): Collection
    {
        return static::query()
            ->active()
            ->with('parent:id,name,slug,parent_id')
            ->ordered()
            ->get()
            ->values();
    }

    public static function rootTreeWithActiveChildren(): Collection
    {
        return static::query()
            ->active()
            ->whereNull('parent_id')
            ->with([
                'children' => fn ($query) => $query->active()->ordered(),
            ])
            ->ordered()
            ->get();
    }

    public static function listingDirectory(?int $selectedCategoryId): array
    {
        $categories = static::query()
            ->active()
            ->ordered()
            ->get(['id', 'name', 'parent_id']);

        $activeListingCounts = Listing::query()
            ->active()
            ->whereNotNull('category_id')
            ->selectRaw('category_id, count(*) as aggregate')
            ->groupBy('category_id')
            ->pluck('aggregate', 'category_id')
            ->map(fn ($count): int => (int) $count);

        return [
            'categories' => static::buildListingDirectoryTree($categories, $activeListingCounts),
            'selectedCategory' => $selectedCategoryId
                ? $categories->firstWhere('id', $selectedCategoryId)
                : null,
            'filterIds' => static::listingFilterIds($selectedCategoryId, $categories),
        ];
    }

    public static function listingFilterIds(?int $selectedCategoryId, ?Collection $categories = null): ?array
    {
        if (! $selectedCategoryId) {
            return null;
        }

        if ($categories instanceof Collection) {
            $selectedCategory = $categories->firstWhere('id', $selectedCategoryId);

            if (! $selectedCategory instanceof self) {
                return [];
            }

            return static::descendantAndSelfIdsFromCollection($selectedCategoryId, $categories);
        }

        $selectedCategory = static::query()
            ->active()
            ->whereKey($selectedCategoryId)
            ->first(['id']);

        if (! $selectedCategory) {
            return [];
        }

        return $selectedCategory->descendantAndSelfIds()->all();
    }

    public function descendantAndSelfIds(): Collection
    {
        $ids = collect([(int) $this->getKey()]);
        $frontier = $ids;

        while ($frontier->isNotEmpty()) {
            $children = static::query()
                ->whereIn('parent_id', $frontier->all())
                ->pluck('id')
                ->map(fn ($id): int => (int) $id)
                ->values();

            if ($children->isEmpty()) {
                break;
            }

            $ids = $ids
                ->merge($children)
                ->unique()
                ->values();

            $frontier = $children;
        }

        return $ids;
    }

    public function breadcrumbTrail(): Collection
    {
        $trail = collect();
        $current = $this;

        while ($current) {
            $trail->prepend($current);
            $current = $current->parent;
        }

        return $trail;
    }

    public function listingCustomFields(): HasMany
    {
        return $this->hasMany(\Modules\Listing\Models\ListingCustomField::class);
    }

    public function activeListings(): HasMany
    {
        return $this->hasMany(\Modules\Listing\Models\Listing::class)->where('status', 'active');
    }

    public function resolvedIconPath(): ?string
    {
        $icon = trim((string) $this->icon);

        if ($icon === '') {
            return null;
        }

        if (isset(self::ICON_PATHS[$icon])) {
            return self::ICON_PATHS[$icon];
        }

        if (preg_match('/\.(png|jpg|jpeg|webp|svg)$/i', $icon) === 1) {
            return ltrim($icon, '/');
        }

        return null;
    }

    public function iconUrl(): ?string
    {
        $path = $this->resolvedIconPath();

        return $path ? asset($path) : null;
    }

    private static function buildListingDirectoryTree(Collection $categories, Collection $activeListingCounts, ?int $parentId = null): Collection
    {
        return $categories
            ->filter(fn (Category $category): bool => $parentId === null
                ? $category->parent_id === null
                : (int) $category->parent_id === $parentId)
            ->values()
            ->map(function (Category $category) use ($categories, $activeListingCounts): Category {
                $children = static::buildListingDirectoryTree($categories, $activeListingCounts, (int) $category->getKey());
                $directActiveListingsCount = (int) $activeListingCounts->get((int) $category->getKey(), 0);
                $activeListingTotal = $directActiveListingsCount + $children->sum(
                    fn (Category $child): int => (int) $child->getAttribute('active_listing_total')
                );

                $category->setRelation('children', $children);
                $category->setAttribute('direct_active_listings_count', $directActiveListingsCount);
                $category->setAttribute('active_listing_total', $activeListingTotal);

                return $category;
            })
            ->values();
    }

    private static function descendantAndSelfIdsFromCollection(int $selectedCategoryId, Collection $categories): array
    {
        $ids = collect([$selectedCategoryId]);
        $frontier = collect([$selectedCategoryId]);

        while ($frontier->isNotEmpty()) {
            $children = $categories
                ->filter(fn (Category $category): bool => $category->parent_id !== null && in_array((int) $category->parent_id, $frontier->all(), true))
                ->pluck('id')
                ->map(fn ($id): int => (int) $id)
                ->values();

            if ($children->isEmpty()) {
                break;
            }

            $ids = $ids
                ->merge($children)
                ->unique()
                ->values();

            $frontier = $children;
        }

        return $ids->all();
    }
}
