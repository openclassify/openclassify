<?php

declare(strict_types=1);

namespace Modules\Listing\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Modules\Listing\Models\Listing;

class ListingServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Listing';

    protected string $moduleNameLower = 'listing';

    public function boot(): void
    {
        $this->loadViewsFrom(module_path($this->moduleName, 'resources/views'), $this->moduleNameLower);
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));
        $this->loadRoutesFrom(module_path($this->moduleName, 'routes/web.php'));
        $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
    }

    public function register(): void
    {
        $this->callAfterResolving(Schedule::class, static function (Schedule $schedule): void {
            $schedule->call(static fn () => Listing::expireOutdated())->name('listing:expire')->hourly()->withoutOverlapping();
        });
    }
}
