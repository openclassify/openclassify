<?php
namespace Modules\Partner\Providers;

use A909M\FilamentStateFusion\FilamentStateFusionPlugin;
use App\Models\User;
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
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Jeffgreco13\FilamentBreezy\BreezyCore;

class PartnerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('partner')
            ->path('partner')
            ->login()
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
}
