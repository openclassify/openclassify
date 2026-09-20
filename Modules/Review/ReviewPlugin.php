<?php

declare(strict_types=1);

namespace Modules\Review;

use Filament\Contracts\Plugin;
use Filament\Panel;

final class ReviewPlugin implements Plugin
{
    public function getId(): string
    {
        return 'review';
    }

    public static function make(): static
    {
        return app(self::class);
    }

    public function register(Panel $panel): void
    {
        $panel->discoverResources(
            in: module_path('Review', 'Filament/Admin/Resources'),
            for: 'Modules\\Review\\Filament\\Admin\\Resources',
        );
    }

    public function boot(Panel $panel): void {}
}
