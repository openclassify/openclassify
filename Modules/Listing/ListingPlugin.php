<?php

namespace Modules\Listing;

use Filament\Contracts\Plugin;
use Filament\Panel;

final class ListingPlugin implements Plugin
{
    public function getId(): string
    {
        return 'listing';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        $panel
            ->discoverResources(
                in: module_path('Listing', 'Filament/Admin/Resources'),
                for: 'Modules\\Listing\\Filament\\Admin\\Resources',
            )
            ->discoverWidgets(
                in: module_path('Listing', 'Filament/Admin/Widgets'),
                for: 'Modules\\Listing\\Filament\\Admin\\Widgets',
            );
    }

    public function boot(Panel $panel): void {}
}
