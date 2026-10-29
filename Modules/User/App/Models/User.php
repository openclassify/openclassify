<?php

declare(strict_types=1);

namespace Modules\User\App\Models;

use App\Support\NotificationDirectory;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Conversation\App\Models\Conversation;
use Modules\Conversation\App\Models\ConversationMessage;
use Modules\Favorite\App\Models\FavoriteListing;
use Modules\Favorite\App\Models\FavoriteSearch;
use Modules\Favorite\App\Models\FavoriteSeller;
use Modules\Listing\Models\Listing;
use Modules\Site\App\Support\LocalMedia;
use Modules\User\App\States\UserStatus;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;
use Spatie\ModelStates\HasStates;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use Billable;
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use HasStates;
    use LogsActivity;
    use Notifiable;
    use SoftDeletes;
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

    public static function demoLoginUser(): self
    {
        return static::query()->where('email', (string) config('demo.login_email', 'a@a.com'))->first()
            ?? throw new \RuntimeException('The seeded demo login user could not be found.');
    }

    public static function registerFrom(array $data): self
    {
        return static::query()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }

    public function updateProfile(array $data): void
    {
        $this->fill($data);
        if ($this->isDirty('email')) {
            $this->email_verified_at = null;
        }
        $this->save();
    }

    public function resetPassword(string $password): void
    {
        $this->forceFill(['password' => $password, 'remember_token' => Str::random(60)])->save();
    }

    public function ownedListing(int $listingId): Listing
    {
        return $this->listings()->whereKey($listingId)->firstOrFail();
    }

    public function updatePassword(string $password): void
    {
        $this->forceFill(['password' => $password])->save();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logExcept(['password'])
            ->logOnlyDirty()
            ->dontLogEmptyChanges();
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return match ($panel->getId()) {
            'admin' => $this->hasRole('admin'),
            default => false,
        };
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function favoriteListings(): HasMany
    {
        return $this->hasMany(FavoriteListing::class);
    }

    public function favoriteSellers(): HasMany
    {
        return $this->hasMany(FavoriteSeller::class);
    }

    public function favoriteSearches(): HasMany
    {
        return $this->hasMany(FavoriteSearch::class);
    }

    public function buyerConversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'buyer_id');
    }

    public function sellerConversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'seller_id');
    }

    public function sentConversationMessages(): HasMany
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
        return FavoriteListing::toggleForUser((int) $this->getKey(), (int) $listing->getKey());
    }

    public function toggleFavoriteSeller(self $seller): bool
    {
        return (int) $seller->getKey() !== (int) $this->getKey()
            && FavoriteSeller::toggleForUser((int) $this->getKey(), (int) $seller->getKey());
    }

    public function rememberListing(Listing $listing): void
    {
        FavoriteListing::remember((int) $this->getKey(), (int) $listing->getKey());
    }

    public function unreadInboxCount(): int
    {
        return Conversation::unreadCountForUser((int) $this->getKey());
    }

    public function unreadNotificationCount(): int
    {
        return NotificationDirectory::unreadCountForUser((int) $this->getKey());
    }

    public function savedListingsCount(): int
    {
        return FavoriteListing::countForUser((int) $this->getKey());
    }

    public function headerBadgeCounts(): array
    {
        return [
            'messages' => $this->unreadInboxCount(),
            'notifications' => $this->unreadNotificationCount(),
            'favorites' => $this->savedListingsCount(),
        ];
    }

    public static function publicProfile(int $id): ?self
    {
        return static::query()->whereKey($id)->first(['id', 'name', 'created_at']);
    }

    public static function summariesByIds(array $ids): Collection
    {
        return static::query()->whereIn('id', $ids)->get(['id', 'name', 'created_at']);
    }

    public static function searchOptions(string $term, int $limit = 50): array
    {
        return static::query()
            ->where(fn (Builder $query): Builder => $query->where('name', 'ilike', "%{$term}%")->orWhere('email', 'ilike', "%{$term}%"))
            ->limit($limit)
            ->get(['id', 'name', 'email'])
            ->mapWithKeys(fn (self $user): array => [$user->getKey() => "{$user->name} ({$user->email})"])
            ->all();
    }

    public static function labelOf(int $id): string
    {
        $user = static::query()->find($id, ['id', 'name', 'email']);

        return $user === null ? (string) $id : "{$user->name} ({$user->email})";
    }

    public static function nameOf(int $id): string
    {
        $name = static::query()->whereKey($id)->value('name');

        return is_string($name) ? $name : '';
    }

    public static function existsById(int $id): bool
    {
        return static::query()->whereKey($id)->exists();
    }

    public static function totalCount(): int
    {
        return (int) static::query()->count();
    }

    public function favoriteListingIds(): array
    {
        return FavoriteListing::idsForUser((int) $this->getKey());
    }

    public function homeFavoriteListingIds(): array
    {
        return $this->favoriteListingIds();
    }

    public function favoriteListingsPage(string $statusFilter = 'all', ?int $categoryId = null, int $perPage = 10): LengthAwarePaginator
    {
        $ids = $this->favoriteListingIds();

        return Listing::query()->whereIn('id', $ids)
            ->with(['category:id,name', 'user:id,name', 'media'])
            ->when($statusFilter === 'active', fn (Builder $query): Builder => $query->active())
            ->when($categoryId, fn (Builder $query): Builder => $query->where('category_id', $categoryId))
            ->orderByRaw('array_position(ARRAY['.implode(',', $ids).']::bigint[], id)')
            ->paginate($perPage)->withQueryString();
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
        $ids = FavoriteSeller::idsForUser((int) $this->getKey());
        $sellers = static::query()->whereIn('id', $ids)
            ->orderByRaw('array_position(ARRAY['.implode(',', $ids).']::bigint[], id)')
            ->paginate($perPage)->withQueryString();
        $counts = Listing::activeCountsForUsers($sellers->pluck('id')->all());
        $sellers->getCollection()->each(static fn (self $seller): mixed => $seller->setAttribute(
            'active_listings_count', $counts[(int) $seller->getKey()] ?? 0,
        ));

        return $sellers;
    }

    public function panelListingOptions(): Collection
    {
        return $this->listings()
            ->latest('id')
            ->get(['id', 'title', 'status']);
    }

    public function loadPanelProfile(): self
    {
        $userId = (int) $this->getKey();

        $this->setAttribute('listings_count', Listing::query()->ownedByUser($userId)->count());
        $this->setAttribute('favorite_listings_count', FavoriteListing::countForUser($userId));
        $this->setAttribute('favorite_sellers_count', FavoriteSeller::countForUser($userId));
        $this->setAttribute('favorite_searches_count', FavoriteSearch::query()->where('user_id', $userId)->count());

        return $this;
    }
}
