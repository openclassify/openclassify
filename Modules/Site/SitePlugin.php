<?php

namespace Modules\Site;

use Filament\Contracts\Plugin;
use Filament\Panel;

final class SitePlugin implements Plugin
{
    public function getId(): string
    {
        return 'site';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        $panel->discoverPages(
            in: module_path('Site', 'Filament/Admin/Pages'),
            for: 'Modules\\Site\\Filament\\Admin\\Pages',
        );
    }

    public function boot(Panel $panel): void {}
}
