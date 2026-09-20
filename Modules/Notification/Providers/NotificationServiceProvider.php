<?php

declare(strict_types=1);

namespace Modules\Notification\Providers;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('Notification', 'Database/migrations'));
        $this->loadRoutesFrom(module_path('Notification', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Notification', 'resources/views'), 'notification');
        $this->loadTranslationsFrom(module_path('Notification', 'lang'), 'notification');
    }

    public function register(): void {}
}
