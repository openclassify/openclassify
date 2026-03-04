<?php

namespace Modules\Theme\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Theme\Support\ThemeManager;

class ThemeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(module_path('Theme', 'config/theme.php'), 'theme');

        $this->app->singleton(ThemeManager::class, function ($app): ThemeManager {
            return new ThemeManager($app['config']);
        });
    }
}
