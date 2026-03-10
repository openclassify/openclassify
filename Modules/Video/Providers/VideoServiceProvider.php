<?php

namespace Modules\Video\Providers;

use Illuminate\Support\ServiceProvider;

class VideoServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(module_path('Video', 'resources/views'), 'video');
        $this->loadMigrationsFrom(module_path('Video', 'Database/migrations'));
    }

    public function register(): void
    {
        $this->mergeConfigFrom(module_path('Video', 'config/video.php'), 'video');
    }
}
