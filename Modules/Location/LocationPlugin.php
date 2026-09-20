<?php

declare(strict_types=1);

namespace Modules\Location;

use Filament\Contracts\Plugin;
use Filament\Panel;

final class LocationPlugin implements Plugin
{
    public function getId(): string
    {
        return 'location';
    }

    public static function make(): static
    {
        return app(self::class);
    }

    public function register(Panel $panel): void
    {
        $panel->discoverResources(
            in: module_path('Location', 'Filament/Admin/Resources'),
            for: 'Modules\\Location\\Filament\\Admin\\Resources',
        );
    }

    public function boot(Panel $panel): void {}
}
