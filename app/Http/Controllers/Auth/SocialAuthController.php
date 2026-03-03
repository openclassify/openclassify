<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class SocialAuthController extends Controller
{
    /**
     * @var array<int, string>
     */
    private array $allowedProviders = ['google', 'facebook', 'apple'];

    public function redirect(string $provider): RedirectResponse
    {
        abort_unless($this->isProviderAllowed($provider), 404);
        abort_unless($this->isProviderEnabled($provider), 404);

        return $this->driver($provider)->redirect();
    }

    public function callback(Request $request, string $provider): RedirectResponse
    {
        abort_unless($this->isProviderAllowed($provider), 404);
        abort_unless($this->isProviderEnabled($provider), 404);

        try {
            $oauthUser = $this->driver($provider)->user();
        } catch (Throwable) {
            return redirect()->route('login')
                ->withErrors(['email' => __('Social login failed. Please try again.')]);
        }

        if (! filled($oauthUser->getId())) {
            return redirect()->route('login')
                ->withErrors(['email' => __('Unable to read social account identity.')]);
        }

        $socialiteUser = DB::table('socialite_users')
            ->where('provider', $provider)
            ->where('provider_id', (string) $oauthUser->getId())
            ->first();

        $user = null;

        if ($socialiteUser?->user_id) {
            $user = User::query()->find($socialiteUser->user_id);
        }

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

        DB::table('socialite_users')->updateOrInsert(
            [
                'provider' => $provider,
                'provider_id' => (string) $oauthUser->getId(),
            ],
            [
                'user_id' => $user->getKey(),
                'updated_at' => now(),
                'created_at' => $socialiteUser?->created_at ?? now(),
            ],
        );

        Auth::guard('web')->login($user, true);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    private function driver(string $provider)
    {
        $driver = Socialite::driver($provider)
            ->redirectUrl(route('auth.social.callback', ['provider' => $provider], absolute: true));

        if ($provider === 'apple' || (bool) config("services.{$provider}.stateless", false)) {
            return $driver->stateless();
        }

        return $driver;
    }

    private function isProviderAllowed(string $provider): bool
    {
        return in_array($provider, $this->allowedProviders, true);
    }

    private function isProviderEnabled(string $provider): bool
    {
        return (bool) config("services.{$provider}.enabled", false)
            && filled(config("services.{$provider}.client_id"))
            && filled(config("services.{$provider}.client_secret"));
    }
}
