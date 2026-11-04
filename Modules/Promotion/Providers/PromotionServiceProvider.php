<?php

declare(strict_types=1);

namespace Modules\Promotion\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Modules\Promotion\Models\PromotionOrder;

class PromotionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('Promotion', 'Database/migrations'));
        $this->loadRoutesFrom(module_path('Promotion', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Promotion', 'resources/views'), 'promotion');
        $this->loadTranslationsFrom(module_path('Promotion', 'lang'), 'promotion');
    }

    public function register(): void
    {
        $this->callAfterResolving(Schedule::class, static function (Schedule $schedule): void {
            $schedule->call(static fn () => PromotionOrder::expireOutdated())->name('promotion:expire')->hourly()->withoutOverlapping();
        });
    }
}
