<?php
namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('Admin', 'database/migrations'));
    }

    public function register(): void
    {
        $this->app->register(AdminPanelProvider::class);
    }
}
