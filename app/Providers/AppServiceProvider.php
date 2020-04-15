<?php

namespace App\Providers;

use Anomaly\FilesModule\File\FileModel;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @param FileModel $fileModel
     * @return void
     */
    public function boot(FileModel $fileModel)
    {
        // Disable file versioning
        $fileModel->disableVersioning();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
