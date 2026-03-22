<?php

namespace Modules\Category;

use Filament\Contracts\Plugin;
use Filament\Panel;

final class CategoryPlugin implements Plugin
{
    public function getId(): string
    {
        return 'category';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        $panel->discoverResources(
            in: module_path('Category', 'Filament/Admin/Resources'),
            for: 'Modules\\Category\\Filament\\Admin\\Resources',
        );
    }

    public function boot(Panel $panel): void {}
}
