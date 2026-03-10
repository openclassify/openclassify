<?php

namespace Modules\Demo\App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Demo\App\Console\CleanupDemoCommand;
use Modules\Demo\App\Console\PrepareDemoCommand;
use Modules\Demo\App\Support\DemoSchemaManager;
use RuntimeException;

class DemoServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DemoSchemaManager::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                PrepareDemoCommand::class,
                CleanupDemoCommand::class,
            ]);
        }
    }

    public function boot(): void
    {
        $this->guardConfiguration();
        $this->loadMigrationsFrom(module_path('Demo', 'Database/migrations'));
        $this->loadRoutesFrom(module_path('Demo', 'routes/web.php'));
    }

    private function guardConfiguration(): void
    {
        if (! config('demo.enabled')) {
            return;
        }

        if (config('database.default') !== 'pgsql') {
            throw new RuntimeException('Demo mode requires DB_CONNECTION=pgsql.');
        }
    }
}
