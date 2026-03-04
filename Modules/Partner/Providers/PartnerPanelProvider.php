<?php
namespace Modules\Partner\Providers;

use A909M\FilamentStateFusion\FilamentStateFusionPlugin;
use App\Models\User;
use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;
use DutchCodingCompany\FilamentSocialite\FilamentSocialitePlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;
use Laravel\Socialite\Contracts\User as SocialiteUserContract;
use Modules\Partner\Support\Filament\SocialiteProviderResolver;
use Spatie\Permission\Models\Role;

class PartnerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('partner')
            ->path('partner')
            ->login()
            ->darkMode(false)
            ->colors(['primary' => Color::Emerald])
            ->tenant(User::class, slugAttribute: 'id')
            ->discoverResources(in: module_path('Partner', 'Filament/Resources'), for: 'Modules\\Partner\\Filament\\Resources')
            ->discoverPages(in: module_path('Partner', 'Filament/Pages'), for: 'Modules\\Partner\\Filament\\Pages')
            ->discoverWidgets(in: module_path('Partner', 'Filament/Widgets'), for: 'Modules\\Partner\\Filament\\Widgets')
            ->plugins([
                FilamentStateFusionPlugin::make(),
                BreezyCore::make()
                    ->myProfile(
                        shouldRegisterNavigation: true,
                        navigationGroup: 'Account',
                        hasAvatars: true,
                        userMenuLabel: 'My Profile',
                    )
                    ->enableTwoFactorAuthentication()
                    ->enableSanctumTokens(),
                FilamentDeveloperLoginsPlugin::make()
                    ->enabled(fn (): bool => app()->environment('local'))
                    ->users([
                        'Partner (Add Listing)' => 'b@b.com',
                    ])
                    ->redirectTo(fn (): ?string => self::partnerCreateListingUrl()),
                self::socialitePlugin(),
            ])
            ->pages([Dashboard::class])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([Authenticate::class]);
    }

    private static function socialitePlugin(): FilamentSocialitePlugin
    {
        return FilamentSocialitePlugin::make()
            ->providers(SocialiteProviderResolver::providers())
            ->registration(true)
            ->resolveUserUsing(function (string $provider, SocialiteUserContract $oauthUser): ?User {
                if (! filled($oauthUser->getEmail())) {
                    return null;
                }

                return User::query()->where('email', strtolower(trim((string) $oauthUser->getEmail())))->first();
            })
            ->createUserUsing(function (string $provider, SocialiteUserContract $oauthUser): User {
                $email = filled($oauthUser->getEmail())
                    ? strtolower(trim((string) $oauthUser->getEmail()))
                    : sprintf('%s_%s@social.local', $provider, $oauthUser->getId());

                $user = User::query()->firstOrCreate(
                    ['email' => $email],
                    [
                        'name' => trim((string) ($oauthUser->getName() ?: $oauthUser->getNickname() ?: ucfirst($provider).' User')),
                        'password' => Hash::make(Str::random(40)),
                        'status' => 'active',
                    ],
                );

                if (class_exists(Role::class)) {
                    $partnerRole = Role::firstOrCreate(['name' => 'partner', 'guard_name' => 'web']);
                    $user->syncRoles([$partnerRole->name]);
                }

                return $user;
            });
    }

    private static function partnerCreateListingUrl(): ?string
    {
        $partner = User::query()->where('email', 'b@b.com')->first();

        if (! $partner) {
            return null;
        }

        return route('filament.partner.resources.listings.create', ['tenant' => $partner->getKey()]);
    }
}
