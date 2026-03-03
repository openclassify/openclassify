<?php
namespace Modules\Admin\Providers;

use A909M\FilamentStateFusion\FilamentStateFusionPlugin;
use DutchCodingCompany\FilamentDeveloperLogins\FilamentDeveloperLoginsPlugin;
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
use MWGuerra\FileManager\FileManagerPlugin;
use MWGuerra\FileManager\Filament\Pages\FileManager;
use Modules\Admin\Filament\Resources\CategoryResource;
use Modules\Admin\Filament\Resources\ListingResource;
use Modules\Admin\Filament\Resources\LocationResource;
use Modules\Admin\Filament\Resources\UserResource;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->default()
            ->path('admin')
            ->login()
            ->colors(['primary' => Color::Blue])
            ->discoverResources(in: module_path('Admin', 'Filament/Resources'), for: 'Modules\\Admin\\Filament\\Resources')
            ->discoverPages(in: module_path('Admin', 'Filament/Pages'), for: 'Modules\\Admin\\Filament\\Pages')
            ->discoverWidgets(in: module_path('Admin', 'Filament/Widgets'), for: 'Modules\\Admin\\Filament\\Widgets')
            ->plugins([
                FilamentStateFusionPlugin::make(),
                BreezyCore::make()
                    ->myProfile(
                        shouldRegisterNavigation: true,
                        navigationGroup: 'Settings',
                        hasAvatars: true,
                        userMenuLabel: 'My Profile',
                    )
                    ->enableTwoFactorAuthentication()
                    ->enableSanctumTokens(),
                FileManagerPlugin::make()->only([
                    FileManager::class,
                ]),
                FilamentDeveloperLoginsPlugin::make()
                    ->enabled(fn (): bool => app()->environment('local'))
                    ->users([
                        'Admin' => 'a@a.com',
                    ]),
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
