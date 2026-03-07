<?php

namespace Modules\S3\Providers;

use Illuminate\Support\ServiceProvider;

class S3ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(module_path('S3', 'config/s3.php'), 'media_storage');
    }
}
