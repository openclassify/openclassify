<?php

namespace Modules\User\App\Support;

use Illuminate\Support\Collection;

class AuthProviderCatalog
{
    private const DEFINITIONS = [
        'google' => [
            'label' => 'Google',
            'login_label' => 'Sign in with Google',
            'register_label' => 'Create account with Google',
        ],
        'apple' => [
            'label' => 'Apple',
            'login_label' => 'Sign in with Apple',
            'register_label' => 'Create account with Apple',
        ],
        'facebook' => [
            'label' => 'Facebook',
            'login_label' => 'Sign in with Facebook',
            'register_label' => 'Create account with Facebook',
        ],
    ];

    public function enabled(string $context, ?string $redirectTo = null): Collection
    {
        return collect(self::DEFINITIONS)
            ->filter(fn (array $provider, string $slug): bool => $this->isEnabled($slug))
            ->map(function (array $provider, string $slug) use ($context, $redirectTo): array {
                return [
                    'id' => $slug,
                    'label' => $provider['label'],
                    'button_label' => $context === 'register'
                        ? $provider['register_label']
                        : $provider['login_label'],
                    'url' => route('auth.social.redirect', array_filter([
                        'provider' => $slug,
                        'redirect' => $redirectTo,
                    ])),
                ];
            })
            ->values();
    }

    public function isAllowed(string $provider): bool
    {
        return array_key_exists($provider, self::DEFINITIONS);
    }

    public function isEnabled(string $provider): bool
    {
        return $this->isAllowed($provider)
            && (bool) config("services.{$provider}.enabled", false)
            && filled(config("services.{$provider}.client_id"))
            && filled(config("services.{$provider}.client_secret"));
    }
}
