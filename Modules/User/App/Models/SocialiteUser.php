<?php

namespace Modules\User\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SocialiteUser extends Model
{
    protected $table = 'socialite_users';

    protected $fillable = ['user_id', 'provider', 'provider_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function resolveUser(string $provider, mixed $oauthUser): User
    {
        $socialiteUser = static::query()
            ->with('user')
            ->where('provider', $provider)
            ->where('provider_id', (string) $oauthUser->getId())
            ->first();
        $user = $socialiteUser?->user;

        if (! $user) {
            $email = filled($oauthUser->getEmail())
                ? strtolower(trim((string) $oauthUser->getEmail()))
                : sprintf('%s_%s@social.local', $provider, $oauthUser->getId());

            $user = User::query()->firstOrCreate(
                ['email' => $email],
                [
                    'name' => trim((string) ($oauthUser->getName() ?: $oauthUser->getNickname() ?: ucfirst($provider).' User')),
                    'password' => Hash::make(Str::random(40)),
                    'status' => 'active',
                    'email_verified_at' => now(),
                ],
            );
        }

        static::query()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => (string) $oauthUser->getId(),
            ],
            [
                'user_id' => $user->getKey(),
            ],
        );

        return $user;
    }
}
