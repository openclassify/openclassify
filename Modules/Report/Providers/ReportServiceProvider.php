<?php

declare(strict_types=1);

namespace Modules\Report\Providers;

use Illuminate\Support\ServiceProvider;

class ReportServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('Report', 'Database/migrations'));
        $this->loadRoutesFrom(module_path('Report', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Report', 'resources/views'), 'report');
        $this->loadTranslationsFrom(module_path('Report', 'lang'), 'report');
    }

    public function register(): void {}
}
