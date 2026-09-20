<?php

declare(strict_types=1);

namespace Modules\Page;

use Filament\Contracts\Plugin;
use Filament\Panel;

final class PagePlugin implements Plugin
{
    public function getId(): string
    {
        return 'page';
    }

    public static function make(): static
    {
        return app(self::class);
    }

    public function register(Panel $panel): void
    {
        $panel->discoverResources(
            in: module_path('Page', 'Filament/Admin/Resources'),
            for: 'Modules\\Page\\Filament\\Admin\\Resources',
        );
    }

    public function boot(Panel $panel): void {}
}
