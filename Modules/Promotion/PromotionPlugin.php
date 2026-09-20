<?php

declare(strict_types=1);

namespace Modules\Promotion;

use Filament\Contracts\Plugin;
use Filament\Panel;

final class PromotionPlugin implements Plugin
{
    public function getId(): string
    {
        return 'promotion';
    }

    public static function make(): static
    {
        return app(self::class);
    }

    public function register(Panel $panel): void
    {
        $panel->discoverResources(
            in: module_path('Promotion', 'Filament/Admin/Resources'),
            for: 'Modules\\Promotion\\Filament\\Admin\\Resources',
        );
    }

    public function boot(Panel $panel): void {}
}
