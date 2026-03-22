<?php

namespace Modules\User\App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Conversation\App\Models\Conversation;
use Modules\Conversation\App\Models\ConversationMessage;
use Modules\Favorite\App\Models\FavoriteSearch;
use Modules\Listing\Models\Listing;
use Modules\Site\App\Support\LocalMedia;
use Modules\User\App\States\UserStatus;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\ModelStates\HasStates;
use Spatie\Permission\Traits\HasRoles;
use Throwable;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use HasStates;
    use LogsActivity;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = ['name', 'email', 'password', 'avatar_url', 'status'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => UserStatus::class,
        ];
    }

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logExcept(['password'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->hasRole('admin'),
            default => false,
        };
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function favoriteListings()
    {
        return $this->belongsToMany(Listing::class, 'favorite_listings')->withTimestamps();
    }

    public function favoriteSellers()
    {
        return $this->belongsToMany(self::class, 'favorite_sellers', 'user_id', 'seller_id')->withTimestamps();
    }

    public function favoriteSearches()
    {
        return $this->hasMany(FavoriteSearch::class);
    }

    public function buyerConversations()
    {
        return $this->hasMany(Conversation::class, 'buyer_id');
    }

    public function sellerConversations()
    {
        return $this->hasMany(Conversation::class, 'seller_id');
    }

    public function sentConversationMessages()
    {
        return $this->hasMany(ConversationMessage::class, 'sender_id');
    }

    public function canImpersonate(): bool
    {
        return $this->hasRole('admin');
    }

    public function canBeImpersonated(): bool
    {
        return ! $this->hasRole('admin');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        if (! filled($this->avatar_url)) {
            return null;
        }

        $path = trim((string) $this->avatar_url);

        if (! LocalMedia::managesPath($path)) {
            return LocalMedia::url($path);
        }

        $disk = LocalMedia::disk();

        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->url($path);
        }

        return LocalMedia::url($path);
    }

    public function getDisplayName(): string
    {
        return trim((string) ($this->name ?: $this->email ?: 'User'));
    }

    public function getEmail(): string
    {
        return trim((string) $this->email);
    }

    public function toggleFavoriteListing(Listing $listing): bool
    {
        $isFavorite = $this->favoriteListings()->whereKey($listing->getKey())->exists();

        if ($isFavorite) {
            $this->favoriteListings()->detach($listing->getKey());

            return false;
        }

        $this->favoriteListings()->syncWithoutDetaching([$listing->getKey()]);

        return true;
    }

    public function toggleFavoriteSeller(self $seller): bool
    {
        if ((int) $seller->getKey() === (int) $this->getKey()) {
            return false;
        }

        $isFavorite = $this->favoriteSellers()->whereKey($seller->getKey())->exists();

        if ($isFavorite) {
            $this->favoriteSellers()->detach($seller->getKey());

            return false;
        }

        $this->favoriteSellers()->syncWithoutDetaching([$seller->getKey()]);

        return true;
    }

    public function rememberListing(Listing $listing): void
    {
        $this->favoriteListings()->syncWithoutDetaching([$listing->getKey()]);
    }

    public function unreadInboxCount(): int
    {
        return Conversation::unreadCountForUser((int) $this->getKey());
    }

    public function unreadNotificationCount(): int
    {
        try {
            return (int) $this->unreadNotifications()->count();
        } catch (Throwable) {
            return 0;
        }
    }

    public function savedListingsCount(): int
    {
        try {
            return (int) $this->favoriteListings()->count();
        } catch (Throwable) {
            return 0;
        }
    }

    public function headerBadgeCounts(): array
    {
        return [
            'messages' => $this->unreadInboxCount(),
            'notifications' => $this->unreadNotificationCount(),
            'favorites' => $this->savedListingsCount(),
        ];
    }

    public static function totalCount(): int
    {
        return (int) static::query()->count();
    }

    public function favoriteListingIds(): array
    {
        return $this->favoriteListings()
            ->pluck('listings.id')
            ->map(fn ($id): int => (int) $id)
            ->all();
    }

    public function homeFavoriteListingIds(): array
    {
        return $this->favoriteListingIds();
    }

    public function favoriteListingsPage(string $statusFilter = 'all', ?int $categoryId = null, int $perPage = 10): LengthAwarePaginator
    {
        return $this->favoriteListings()
            ->with(['category:id,name', 'user:id,name'])
            ->wherePivot('created_at', '>=', now()->subYear())
            ->when($statusFilter === 'active', fn ($query) => $query->where('status', 'active'))
            ->when($categoryId, fn ($query) => $query->where('category_id', $categoryId))
            ->orderByPivot('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function favoriteSearchesPage(int $perPage = 10): LengthAwarePaginator
    {
        return $this->favoriteSearches()
            ->with('category:id,name')
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function favoriteSellersPage(int $perPage = 10): LengthAwarePaginator
    {
        return $this->favoriteSellers()
            ->withCount([
                'listings as active_listings_count' => fn ($query) => $query->where('status', 'active'),
            ])
            ->orderByPivot('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function panelListingOptions(): Collection
    {
        return $this->listings()
            ->latest('id')
            ->get(['id', 'title', 'status']);
    }

    public function loadPanelProfile(): self
    {
        return $this->loadCount([
            'listings',
            'favoriteListings',
            'favoriteSearches',
            'favoriteSellers',
        ]);
    }
}
