<?php

namespace Modules\User;

use Filament\Contracts\Plugin;
use Filament\Panel;

final class UserPlugin implements Plugin
{
    public function getId(): string
    {
        return 'user';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function register(Panel $panel): void
    {
        $panel->discoverResources(
            in: module_path('User', 'Filament/Admin/Resources'),
            for: 'Modules\\User\\Filament\\Admin\\Resources',
        );
    }

    public function boot(Panel $panel): void {}
}
