<?php

declare(strict_types=1);

namespace Modules\Notification;

use Filament\Contracts\Plugin;
use Filament\Panel;

final class NotificationPlugin implements Plugin
{
    public function getId(): string
    {
        return 'notification';
    }

    public static function make(): static
    {
        return app(self::class);
    }

    public function register(Panel $panel): void
    {
        $panel->discoverResources(
            in: module_path('Notification', 'Filament/Admin/Resources'),
            for: 'Modules\\Notification\\Filament\\Admin\\Resources',
        );
    }

    public function boot(Panel $panel): void {}
}
