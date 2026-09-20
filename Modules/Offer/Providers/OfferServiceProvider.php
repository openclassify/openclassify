<?php

declare(strict_types=1);

namespace Modules\Offer\Providers;

use Illuminate\Support\ServiceProvider;

class OfferServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('Offer', 'Database/migrations'));
        $this->loadRoutesFrom(module_path('Offer', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Offer', 'resources/views'), 'offer');
        $this->loadTranslationsFrom(module_path('Offer', 'lang'), 'offer');
    }

    public function register(): void {}
}
