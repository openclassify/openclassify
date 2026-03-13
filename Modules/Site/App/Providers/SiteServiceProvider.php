<?php

namespace Modules\Site\App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SiteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $viewPath = module_path('Site', 'resources/views');

        $this->loadRoutesFrom(module_path('Site', 'routes/web.php'));
        $this->loadViewsFrom($viewPath, 'site');
        View::addNamespace('app', $viewPath);
    }
}
