<?php
namespace Modules\Category\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;

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

    public static function filterOptions(): Collection
    {
        return static::query()
            ->active()
            ->ordered()
            ->get(['id', 'name']);
    }

    public static function themePills(int $limit = 8): Collection
    {
        return static::query()
            ->active()
            ->ordered()
            ->limit($limit)
            ->get(['id', 'name', 'slug']);
    }

    public static function rootTreeWithActiveChildren(): Collection
    {
        return static::query()
            ->active()
            ->whereNull('parent_id')
            ->with([
                'children' => fn (Builder $query) => $query->active()->ordered(),
            ])
            ->ordered()
            ->get();
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
}
