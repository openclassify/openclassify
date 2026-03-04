<?php

namespace Modules\User\App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Conversation\App\Models\Conversation;
use Modules\Conversation\App\Models\ConversationMessage;
use Modules\Favorite\App\Models\FavoriteSearch;
use Modules\Listing\Models\Listing;
use Modules\User\App\States\UserStatus;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\ModelStates\HasStates;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasTenants, HasAvatar
{
    use HasApiTokens;
    use HasFactory;
    use HasRoles;
    use LogsActivity;
    use Notifiable;
    use HasStates;
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
        return \Database\Factories\UserFactory::new();
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

    public function getTenants(Panel $panel): Collection
    {
        return collect([$this]);
    }

    public function canAccessTenant(Model $tenant): bool
    {
        return $tenant->getKey() === $this->getKey();
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
        return filled($this->avatar_url) ? Storage::disk('public')->url($this->avatar_url) : null;
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
}
