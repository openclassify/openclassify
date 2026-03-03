<?php
namespace App\Models;

use App\States\UserStatus;
use Filament\Models\Contracts\HasAvatar;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasTenants;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Jeffgreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\ModelStates\HasStates;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser, HasTenants, HasAvatar
{
    use HasApiTokens, HasFactory, HasRoles, LogsActivity, Notifiable, HasStates, TwoFactorAuthenticatable;

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
            'partner' => true,
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
        return $this->hasMany(\Modules\Listing\Models\Listing::class);
    }

    public function favoriteListings()
    {
        return $this->belongsToMany(\Modules\Listing\Models\Listing::class, 'favorite_listings')
            ->withTimestamps();
    }

    public function favoriteSellers()
    {
        return $this->belongsToMany(self::class, 'favorite_sellers', 'user_id', 'seller_id')
            ->withTimestamps();
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
        return filled($this->avatar_url)
            ? Storage::disk('public')->url($this->avatar_url)
            : null;
    }
}
