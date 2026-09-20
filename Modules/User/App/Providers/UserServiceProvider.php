<?php

declare(strict_types=1);

namespace Modules\User\App\Providers;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('User', 'Database/migrations'));
        $this->loadRoutesFrom(module_path('User', 'routes/web.php'));
        $this->loadViewsFrom(module_path('User', 'resources/views'), 'user');
        $this->loadTranslationsFrom(module_path('User', 'lang'), 'user');
    }

    public function register(): void {}
}
