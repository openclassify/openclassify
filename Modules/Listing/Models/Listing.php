<?php
namespace Modules\Listing\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Modules\Listing\States\ListingStatus;
use Modules\Listing\Support\ListingPanelHelper;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\ModelStates\HasStates;

class Listing extends Model implements HasMedia
{
    use HasFactory, HasStates, InteractsWithMedia, LogsActivity;

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
        return $this->belongsTo(\Modules\Category\Models\Category::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function favoritedByUsers()
    {
        return $this->belongsToMany(\App\Models\User::class, 'favorite_listings')
            ->withTimestamps();
    }

    public function conversations()
    {
        return $this->hasMany(\App\Models\Conversation::class);
    }

    public function scopePublicFeed(Builder $query): Builder
    {
        return $query
            ->where('status', 'active')
            ->orderByDesc('is_featured')
            ->orderByDesc('created_at');
    }

    public static function createFromFrontend(array $data, null | int | string $userId): self
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
        $this->addMediaCollection('listing-images');
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
