<?php

declare(strict_types=1);

namespace Modules\Promotion\Providers;

use Illuminate\Support\ServiceProvider;

class PromotionServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('Promotion', 'Database/migrations'));
        $this->loadRoutesFrom(module_path('Promotion', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Promotion', 'resources/views'), 'promotion');
        $this->loadTranslationsFrom(module_path('Promotion', 'lang'), 'promotion');
    }

    public function register(): void {}
}
