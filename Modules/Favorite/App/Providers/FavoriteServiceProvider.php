<?php

namespace Modules\Favorite\App\Providers;

use Illuminate\Support\ServiceProvider;

class FavoriteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('Favorite', 'Database/migrations'));
        $this->loadRoutesFrom(module_path('Favorite', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Favorite', 'resources/views'), 'favorite');
    }

    public function register(): void {}
}
