<?php

declare(strict_types=1);

use App\Providers\AppServiceProvider;
use Modules\Admin\Providers\AdminPanelProvider;

return [
    AppServiceProvider::class,
    AdminPanelProvider::class,
];
