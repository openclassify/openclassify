<?php

declare(strict_types=1);

namespace Modules\Site\App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Site\App\Support\LocalMedia;
use Modules\Site\App\Support\ScopedMediaPathGenerator;
use Modules\Site\App\View\SiteLayoutComposer;

class SiteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        config([
            'filesystems.default' => LocalMedia::disk(),
            'filament.default_filesystem_disk' => LocalMedia::disk(),
            'filemanager.storage_mode.disk' => LocalMedia::disk(),
            'filemanager.upload.disk' => LocalMedia::disk(),
            'media-library.disk_name' => LocalMedia::disk(),
            'media-library.path_generator' => ScopedMediaPathGenerator::class,
            'video.disk' => LocalMedia::disk(),
        ]);
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(module_path('Site', 'Database/migrations'));
        $this->loadRoutesFrom(module_path('Site', 'routes/web.php'));
        $this->loadViewsFrom(module_path('Site', 'resources/views'), 'site');
        $this->loadTranslationsFrom(module_path('Site', 'lang'), 'site');
        View::composer('site::layouts.app', SiteLayoutComposer::class);
    }
}
