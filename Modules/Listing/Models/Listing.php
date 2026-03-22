<?php

namespace Modules\Listing\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Modules\Category\Models\Category;
use Modules\Conversation\App\Models\Conversation;
use Modules\Listing\States\ListingStatus;
use Modules\Listing\Support\ListingImageViewData;
use Modules\Listing\Support\ListingPanelHelper;
use Modules\Site\App\Support\LocalMedia;
use Modules\User\App\Models\User;
use Modules\Video\Enums\VideoStatus;
use Modules\Video\Models\Video;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\ModelStates\HasStates;
use Throwable;

class Listing extends Model implements HasMedia
{
    use HasFactory, HasStates, InteractsWithMedia, LogsActivity;

    private const DEFAULT_PANEL_EXPIRY_WINDOW_DAYS = 30;

    protected $fillable = [
        'title', 'description', 'price', 'currency', 'category_id',
        'user_id', 'status', 'images', 'custom_fields', 'slug',
        'contact_phone', 'contact_email', 'is_featured', 'expires_at',
        'city', 'country', 'latitude', 'longitude', 'location', 'view_count',
    ];

    protected $casts = [
        'images' => 'array',
        'custom_fields' => 'array',
        'is_featured' => 'boolean',
        'view_count' => 'integer',
        'expires_at' => 'datetime',
        'price' => 'decimal:2',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'status' => ListingStatus::class,
    ];

    protected $appends = ['location'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favorite_listings')
            ->withTimestamps();
    }

    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class)->ordered();
    }

    public function scopePublicFeed(Builder $query): Builder
    {
        return $query
            ->active()
            ->orderByDesc('is_featured')
            ->orderByDesc('created_at');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'active');
    }

    public function scopeOwnedByUser(Builder $query, int|string|null $userId): Builder
    {
        return $query->where('user_id', $userId);
    }

    public function scopeForPanelStatus(Builder $query, string $status): Builder
    {
        return match ($status) {
            'sold', 'expired', 'pending', 'active' => $query->where('status', $status),
            default => $query,
        };
    }

    public function scopeSearchTerm(Builder $query, string $search): Builder
    {
        $search = trim($search);

        if ($search === '') {
            return $query;
        }

        return $query->where(function (Builder $searchQuery) use ($search): void {
            $searchQuery
                ->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('city', 'like', "%{$search}%")
                ->orWhere('country', 'like', "%{$search}%");
        });
    }

    public function scopeWithPanelIndexState(Builder $query): Builder
    {
        return $query
            ->with('category:id,name')
            ->withCount('favoritedByUsers')
            ->withCount('videos')
            ->withCount([
                'videos as ready_videos_count' => fn (Builder $videoQuery): Builder => $videoQuery
                    ->whereNotNull('path')
                    ->where('is_active', true),
                'videos as pending_videos_count' => fn (Builder $videoQuery): Builder => $videoQuery
                    ->whereIn('status', [
                        VideoStatus::Pending->value,
                        VideoStatus::Processing->value,
                    ]),
            ]);
    }

    public function scopeForCategory(Builder $query, ?int $categoryId): Builder
    {
        return $query->forCategoryIds(Category::listingFilterIds($categoryId));
    }

    public function scopeForCategoryIds(Builder $query, ?array $categoryIds): Builder
    {
        if ($categoryIds === null) {
            return $query;
        }

        if ($categoryIds === []) {
            return $query->whereRaw('1 = 0');
        }

        return $query->whereIn('category_id', $categoryIds);
    }

    public function scopeForBrowseFilters(Builder $query, array $filters): Builder
    {
        $search = trim((string) ($filters['search'] ?? ''));
        $country = isset($filters['country']) ? trim((string) $filters['country']) : null;
        $city = isset($filters['city']) ? trim((string) $filters['city']) : null;
        $userId = isset($filters['user_id']) && is_numeric($filters['user_id']) ? (int) $filters['user_id'] : null;
        $minPrice = is_numeric($filters['min_price'] ?? null) ? max((float) $filters['min_price'], 0) : null;
        $maxPrice = is_numeric($filters['max_price'] ?? null) ? max((float) $filters['max_price'], 0) : null;
        $dateFilter = (string) ($filters['date_filter'] ?? 'all');
        $categoryIds = $filters['category_ids'] ?? null;

        $query
            ->searchTerm($search)
            ->forCategoryIds(is_array($categoryIds) ? $categoryIds : null)
            ->when(! is_null($userId) && $userId > 0, fn (Builder $builder) => $builder->where('user_id', $userId))
            ->when($country !== null && $country !== '', fn (Builder $builder) => $builder->where('country', $country))
            ->when($city !== null && $city !== '', fn (Builder $builder) => $builder->where('city', $city))
            ->when(! is_null($minPrice), fn (Builder $builder) => $builder->whereNotNull('price')->where('price', '>=', $minPrice))
            ->when(! is_null($maxPrice), fn (Builder $builder) => $builder->whereNotNull('price')->where('price', '<=', $maxPrice));

        return match ($dateFilter) {
            'today' => $query->where('created_at', '>=', Carbon::now()->startOfDay()),
            'week' => $query->where('created_at', '>=', Carbon::now()->subDays(7)),
            'month' => $query->where('created_at', '>=', Carbon::now()->subDays(30)),
            default => $query,
        };
    }

    public function scopeApplyBrowseSort(Builder $query, string $sort): Builder
    {
        return match ($sort) {
            'newest' => $query->reorder()->orderByDesc('created_at'),
            'oldest' => $query->reorder()->orderBy('created_at'),
            'price_asc' => $query->reorder()->orderByRaw('price is null')->orderBy('price'),
            'price_desc' => $query->reorder()->orderByRaw('price is null')->orderByDesc('price'),
            default => $query->reorder()->orderByDesc('is_featured')->orderByDesc('created_at'),
        };
    }

    public function themeGallery(): array
    {
        return collect($this->galleryImageData())
            ->map(fn (array $image): ?string => ListingImageViewData::pickUrl($image['gallery'] ?? null))
            ->filter(fn (?string $url): bool => is_string($url) && $url !== '')
            ->values()
            ->all();
    }

    public function galleryImageData(): array
    {
        $mediaItems = $this->getMedia('listing-images');

        if ($mediaItems->isNotEmpty()) {
            return $mediaItems
                ->map(fn (Media $media): array => [
                    'gallery' => ListingImageViewData::fromMedia($media, 'gallery'),
                    'thumb' => ListingImageViewData::fromMedia($media, 'thumb'),
                ])
                ->values()
                ->all();
        }

        return collect($this->images ?? [])
            ->filter(fn ($value): bool => is_string($value) && trim($value) !== '')
            ->map(fn (string $url): array => [
                'gallery' => ListingImageViewData::fromUrl($url),
                'thumb' => ListingImageViewData::fromUrl($url),
            ])
            ->values()
            ->all();
    }

    public function primaryImageData(string $context = 'card'): ?array
    {
        $media = $this->getFirstMedia('listing-images');

        if ($media instanceof Media) {
            return ListingImageViewData::fromMedia($media, $context);
        }

        $fallback = collect($this->images ?? [])
            ->first(fn ($value): bool => is_string($value) && trim($value) !== '');

        return ListingImageViewData::fromUrl(is_string($fallback) ? $fallback : null);
    }

    public function primaryImageUrl(string $context = 'card', string $viewport = 'desktop'): ?string
    {
        return ListingImageViewData::pickUrl($this->primaryImageData($context), $viewport);
    }

    public function relatedSuggestions(int $limit = 8): Collection
    {
        $baseQuery = static::query()
            ->publicFeed()
            ->with(['category:id,name', 'videos'])
            ->whereKeyNot($this->getKey());

        $primary = (clone $baseQuery)
            ->forCategory($this->category_id ? (int) $this->category_id : null)
            ->limit($limit)
            ->get();

        if ($primary->count() >= $limit) {
            return $primary;
        }

        $missing = $limit - $primary->count();
        $excludeIds = $primary->pluck('id')->push($this->getKey())->all();
        $fallback = (clone $baseQuery)
            ->whereNotIn('id', $excludeIds)
            ->limit($missing)
            ->get();

        return $primary->concat($fallback)->values();
    }

    public static function panelStatusOptions(): array
    {
        return [
            'pending' => 'Pending',
            'active' => 'Active',
            'sold' => 'Sold',
            'expired' => 'Expired',
        ];
    }

    public static function panelStatusCountsForUser(int|string $userId): array
    {
        $counts = static::query()
            ->ownedByUser($userId)
            ->selectRaw('status, COUNT(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return [
            'all' => (int) $counts->sum(),
            'active' => (int) ($counts['active'] ?? 0),
            'pending' => (int) ($counts['pending'] ?? 0),
            'sold' => (int) ($counts['sold'] ?? 0),
            'expired' => (int) ($counts['expired'] ?? 0),
        ];
    }

    public static function activeCount(): int
    {
        return (int) static::query()
            ->active()
            ->count();
    }

    public static function overviewStats(): array
    {
        $counts = static::query()
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END) as active")
            ->selectRaw("SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending")
            ->selectRaw('SUM(CASE WHEN is_featured = true THEN 1 ELSE 0 END) as featured')
            ->first();

        return [
            'total' => (int) ($counts?->total ?? 0),
            'active' => (int) ($counts?->active ?? 0),
            'pending' => (int) ($counts?->pending ?? 0),
            'featured' => (int) ($counts?->featured ?? 0),
            'created_today' => (int) static::query()
                ->where('created_at', '>=', now()->startOfDay())
                ->count(),
        ];
    }

    public static function creationTrend(int $days): array
    {
        $safeDays = max(1, $days);
        $startDate = now()->startOfDay()->subDays($safeDays - 1);
        $countsByDate = static::query()
            ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->where('created_at', '>=', $startDate)
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day')
            ->all();
        $labels = [];
        $data = [];

        for ($index = 0; $index < $safeDays; $index++) {
            $date = $startDate->copy()->addDays($index);
            $dateKey = $date->toDateString();

            $labels[] = $date->format('M j');
            $data[] = (int) ($countsByDate[$dateKey] ?? 0);
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    public static function homeFeatured(int $limit = 4): Collection
    {
        return static::query()
            ->active()
            ->where('is_featured', true)
            ->latest()
            ->take($limit)
            ->get();
    }

    public static function homeRecent(int $limit = 8): Collection
    {
        return static::query()
            ->active()
            ->latest()
            ->take($limit)
            ->get();
    }

    public static function panelIndexDataForUser(User $user, string $search, string $status): array
    {
        $listings = static::query()
            ->ownedByUser($user->getKey())
            ->withPanelIndexState()
            ->searchTerm($search)
            ->forPanelStatus($status)
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return [
            'listings' => $listings,
            'counts' => static::panelStatusCountsForUser($user->getKey()),
        ];
    }

    public function panelPrimaryImageUrl(): ?string
    {
        return $this->primaryImageUrl('card', 'desktop');
    }

    public function panelPriceLabel(): string
    {
        if (is_null($this->price)) {
            return 'Free';
        }

        return number_format((float) $this->price, 2, ',', '.').' '.($this->currency ?? 'TL');
    }

    public function panelStatusMeta(): array
    {
        return match ($this->statusValue()) {
            'sold' => [
                'label' => 'Sold',
                'badge_class' => 'is-success',
                'hint' => 'This listing is marked as sold.',
            ],
            'expired' => [
                'label' => 'Expired',
                'badge_class' => 'is-danger',
                'hint' => 'This listing is waiting to be republished.',
            ],
            'pending' => [
                'label' => 'Pending review',
                'badge_class' => 'is-warning',
                'hint' => 'Waiting for moderation approval.',
            ],
            default => [
                'label' => 'Live',
                'badge_class' => 'is-primary',
                'hint' => 'Visible to visitors right now.',
            ],
        };
    }

    public function panelLocationLabel(): string
    {
        $parts = collect([
            trim((string) $this->city),
            trim((string) $this->country),
        ])->filter()->values();

        return $parts->isNotEmpty() ? $parts->implode(', ') : 'Location not specified';
    }

    public function panelPublishedAt(): ?Carbon
    {
        $createdAt = $this->created_at?->copy();
        $expiresAt = $this->expires_at?->copy();

        if (! $createdAt) {
            return $expiresAt;
        }

        if (! $expiresAt || $expiresAt->greaterThanOrEqualTo($createdAt)) {
            return $createdAt;
        }

        return $expiresAt->subDays(self::DEFAULT_PANEL_EXPIRY_WINDOW_DAYS);
    }

    public function panelExpirySummary(): string
    {
        if (! $this->expires_at) {
            return 'No expiry limit';
        }

        $expiresAt = $this->expires_at->copy()->startOfDay();
        $days = Carbon::today()->diffInDays($expiresAt, false);

        return match (true) {
            $days > 0 => $days.' days left',
            $days === 0 => 'Ends today',
            default => 'Expired '.abs($days).' days ago',
        };
    }

    public function panelVideoSummary(int $total, int $ready, int $pending): ?array
    {
        if ($total < 1) {
            return null;
        }

        return [
            'label' => $total.' videos',
            'detail' => $ready.' ready'.($pending > 0 ? ', '.$pending.' processing' : ''),
        ];
    }

    public function replacePublicImage(string $absolutePath, ?string $fileName = null): void
    {
        if (! is_file($absolutePath)) {
            return;
        }

        $disk = $this->mediaDisk();
        $targetFileName = trim((string) ($fileName ?: basename($absolutePath)));
        $existingMediaItems = $this->getMedia('listing-images');

        if ($existingMediaItems->count() === 1) {
            $existingMedia = $existingMediaItems->first();

            if (
                $existingMedia
                && (string) $existingMedia->file_name === $targetFileName
                && (string) $existingMedia->disk === $disk
            ) {
                try {
                    if (is_file($existingMedia->getPath())) {
                        return;
                    }
                } catch (Throwable) {
                }
            }
        }

        $this->clearMediaCollection('listing-images');
        $this->attachListingImage($absolutePath, $targetFileName, $disk);
    }

    public function attachListingImage(string $absolutePath, string $fileName, ?string $disk = null): void
    {
        if (! is_file($absolutePath)) {
            return;
        }

        $targetDisk = is_string($disk) && trim($disk) !== ''
            ? trim($disk)
            : $this->mediaDisk();

        $this
            ->addMedia($absolutePath)
            ->usingFileName(trim($fileName))
            ->withCustomProperties(self::mediaCustomProperties())
            ->preservingOriginal()
            ->toMediaCollection('listing-images', $targetDisk);
    }

    public function statusValue(): string
    {
        return $this->status instanceof ListingStatus
            ? $this->status->getValue()
            : (string) $this->status;
    }

    public function statusLabel(): string
    {
        return match ($this->statusValue()) {
            'sold' => 'Sold',
            'expired' => 'Expired',
            'pending' => 'Pending',
            default => 'Active',
        };
    }

    public function loadPanelEditor(): self
    {
        return $this->load([
            'category:id,name',
            'videos:id,listing_id,title,status,is_active,path,upload_path,duration_seconds,size',
        ]);
    }

    public function assertOwnedBy(User $user): void
    {
        abort_unless((int) $this->user_id === (int) $user->getKey(), 403);
    }

    public function trackViewBy(null|int|string $viewerId): void
    {
        if ((int) $this->user_id === (int) $viewerId) {
            return;
        }

        $this->increment('view_count');
        $this->refresh();
    }

    public function markAsSold(): void
    {
        $this->forceFill([
            'status' => 'sold',
        ])->save();
    }

    public function republish(): void
    {
        $this->forceFill([
            'status' => 'active',
            'expires_at' => now()->addDays(self::DEFAULT_PANEL_EXPIRY_WINDOW_DAYS),
        ])->save();
    }

    public function updateFromPanel(array $attributes): void
    {
        $payload = Arr::only($attributes, [
            'title',
            'description',
            'price',
            'status',
            'contact_phone',
            'contact_email',
            'country',
            'city',
            'expires_at',
        ]);

        if (array_key_exists('currency', $attributes)) {
            $payload['currency'] = ListingPanelHelper::normalizeCurrency($attributes['currency']);
        }

        if (array_key_exists('custom_fields', $attributes)) {
            $payload['custom_fields'] = $attributes['custom_fields'];
        }

        $this->forceFill($payload)->save();
    }

    public static function createFromFrontend(array $data, null|int|string $userId): self
    {
        $baseSlug = Str::slug((string) ($data['title'] ?? 'listing'));
        $baseSlug = $baseSlug !== '' ? $baseSlug : 'listing';

        do {
            $slug = $baseSlug.'-'.Str::random(6);
        } while (static::query()->where('slug', $slug)->exists());

        $payload = $data;
        $payload['user_id'] = $userId;
        $payload['currency'] = ListingPanelHelper::normalizeCurrency($data['currency'] ?? null);
        $payload['slug'] = $slug;

        return static::query()->create($payload);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('listing-images')->useDisk($this->mediaDisk());
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        if ($this->shouldSkipConversionsForSeeder()) {
            return;
        }

        $this
            ->addMediaConversion('gallery-mobile')
            ->fit(Fit::Max, 960, 960)
            ->format('webp')
            ->quality(78)
            ->performOnCollections('listing-images')
            ->nonQueued();

        $this
            ->addMediaConversion('gallery-desktop')
            ->fit(Fit::Max, 1680, 1680)
            ->format('webp')
            ->quality(82)
            ->performOnCollections('listing-images')
            ->nonQueued();

        $this
            ->addMediaConversion('card-mobile')
            ->fit(Fit::Crop, 720, 540)
            ->format('webp')
            ->quality(76)
            ->performOnCollections('listing-images')
            ->nonQueued();

        $this
            ->addMediaConversion('card-desktop')
            ->fit(Fit::Crop, 1080, 810)
            ->format('webp')
            ->quality(80)
            ->performOnCollections('listing-images')
            ->nonQueued();

        $this
            ->addMediaConversion('thumb-mobile')
            ->fit(Fit::Crop, 220, 220)
            ->format('webp')
            ->quality(74)
            ->performOnCollections('listing-images')
            ->nonQueued();

        $this
            ->addMediaConversion('thumb-desktop')
            ->fit(Fit::Crop, 320, 320)
            ->format('webp')
            ->quality(78)
            ->performOnCollections('listing-images')
            ->nonQueued();
    }

    private function shouldSkipConversionsForSeeder(): bool
    {
        if ((bool) config('demo.provisioning', false)) {
            return true;
        }

        if (! app()->runningInConsole()) {
            return false;
        }

        $argv = implode(' ', (array) ($_SERVER['argv'] ?? []));

        return str_contains($argv, 'db:seed') || str_contains($argv, '--seed');
    }

    private function mediaDisk(): string
    {
        return LocalMedia::disk();
    }

    public static function mediaCustomProperties(): array
    {
        $scope = static::mediaPathScope();

        return $scope !== null
            ? ['path_scope' => $scope]
            : [];
    }

    public static function mediaPathScope(): ?string
    {
        $connection = (string) config('database.default', 'pgsql');
        $searchPath = config("database.connections.{$connection}.search_path");
        $value = is_array($searchPath)
            ? implode('_', $searchPath)
            : (string) $searchPath;
        $scope = (string) Str::of($value)
            ->before(',')
            ->trim()
            ->lower()
            ->replaceMatches('/[^a-z0-9_]+/', '_')
            ->trim('_');

        return $scope !== '' ? $scope : null;
    }

    protected function location(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes): ?array {
                $latitude = $attributes['latitude'] ?? null;
                $longitude = $attributes['longitude'] ?? null;

                if ($latitude === null || $longitude === null) {
                    return null;
                }

                return [
                    'lat' => (float) $latitude,
                    'lng' => (float) $longitude,
                ];
            },
            set: fn (?array $value): array => [
                'latitude' => is_array($value) ? ($value['lat'] ?? null) : null,
                'longitude' => is_array($value) ? ($value['lng'] ?? null) : null,
            ],
        );
    }
}
