<?php

declare(strict_types=1);

namespace Modules\Review\Providers;

use Illuminate\Support\ServiceProvider;

class ReviewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('Review', 'Database/migrations'));
        $this->loadRoutesFrom(module_path('Review', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Review', 'resources/views'), 'review');
        $this->loadTranslationsFrom(module_path('Review', 'lang'), 'review');
    }

    public function register(): void {}
}
