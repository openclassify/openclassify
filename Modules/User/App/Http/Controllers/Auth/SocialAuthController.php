<?php

namespace Modules\User\App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Modules\User\App\Models\SocialiteUser;
use Modules\User\App\Models\User;
use Modules\User\App\Support\AuthProviderCatalog;
use Modules\User\App\Support\AuthRedirector;
use Throwable;

class SocialAuthController extends Controller
{
    public function __construct(
        private AuthProviderCatalog $providers,
        private AuthRedirector $redirector,
    ) {
    }

    public function redirect(Request $request, string $provider): RedirectResponse
    {
        abort_unless($this->providers->isAllowed($provider), 404);
        abort_unless($this->providers->isEnabled($provider), 404);

        $this->redirector->rememberQueryTarget($request);

        return $this->driver($provider)->redirect();
    }

    public function callback(Request $request, string $provider): RedirectResponse
    {
        abort_unless($this->providers->isAllowed($provider), 404);
        abort_unless($this->providers->isEnabled($provider), 404);

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

        $user = $this->resolveUser($provider, $oauthUser);

        Auth::guard('web')->login($user, true);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    private function resolveUser(string $provider, mixed $oauthUser): User
    {
        return SocialiteUser::resolveUser($provider, $oauthUser);
    }

    private function driver(string $provider): mixed
    {
        $driver = Socialite::driver($provider)
            ->redirectUrl(route('auth.social.callback', ['provider' => $provider], absolute: true));

        if ($provider === 'apple' || (bool) config("services.{$provider}.stateless", false)) {
            return $driver->stateless();
        }

        return $driver;
    }
}
