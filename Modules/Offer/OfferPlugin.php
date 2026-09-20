<?php

declare(strict_types=1);

namespace Modules\Offer;

use Filament\Contracts\Plugin;
use Filament\Panel;

final class OfferPlugin implements Plugin
{
    public function getId(): string
    {
        return 'offer';
    }

    public static function make(): static
    {
        return app(self::class);
    }

    public function register(Panel $panel): void
    {
        $panel->discoverResources(
            in: module_path('Offer', 'Filament/Admin/Resources'),
            for: 'Modules\\Offer\\Filament\\Admin\\Resources',
        );
    }

    public function boot(Panel $panel): void {}
}
