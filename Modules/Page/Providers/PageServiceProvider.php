<?php

declare(strict_types=1);

namespace Modules\Page\Providers;

use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('Page', 'Database/migrations'));
        $this->loadRoutesFrom(module_path('Page', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Page', 'resources/views'), 'page');
        $this->loadTranslationsFrom(module_path('Page', 'lang'), 'page');
    }

    public function register(): void {}
}
