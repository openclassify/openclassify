<?php

declare(strict_types=1);

namespace Modules\Report;

use Filament\Contracts\Plugin;
use Filament\Panel;

final class ReportPlugin implements Plugin
{
    public function getId(): string
    {
        return 'report';
    }

    public static function make(): static
    {
        return app(self::class);
    }

    public function register(Panel $panel): void
    {
        $panel->discoverResources(
            in: module_path('Report', 'Filament/Admin/Resources'),
            for: 'Modules\\Report\\Filament\\Admin\\Resources',
        );
    }

    public function boot(Panel $panel): void {}
}
