<?php

namespace Modules\Listing\Providers;

use Illuminate\Support\ServiceProvider;

class ListingServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Listing';

    protected string $moduleNameLower = 'listing';

    public function boot(): void
    {
        $this->loadViewsFrom(module_path($this->moduleName, 'resources/views'), $this->moduleNameLower);
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));
        $this->loadRoutesFrom(module_path($this->moduleName, 'routes/web.php'));
    }

    public function register(): void
    {}
}
