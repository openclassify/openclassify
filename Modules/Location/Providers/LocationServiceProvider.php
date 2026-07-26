<?php

declare(strict_types=1);

namespace Modules\Location\Providers;

use Illuminate\Support\ServiceProvider;

class LocationServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Location';

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));
        $this->loadRoutesFrom(module_path($this->moduleName, 'routes/web.php'));
    }

    public function register(): void {}
}
