<?php
namespace Modules\Profile\Providers;

use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Profile';

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'database/migrations'));
        $this->loadRoutesFrom(module_path($this->moduleName, 'routes/web.php'));
        $this->loadViewsFrom(module_path($this->moduleName, 'resources/views'), 'profile');
    }

    public function register(): void {}
}
