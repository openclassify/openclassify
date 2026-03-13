<?php

namespace Modules\Panel\App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Modules\Panel\App\Livewire\PanelQuickListingForm;

class PanelServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(module_path('Panel', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Panel', 'resources/views'), 'panel');

        Livewire::component('panel-quick-listing-form', PanelQuickListingForm::class);
    }
}
