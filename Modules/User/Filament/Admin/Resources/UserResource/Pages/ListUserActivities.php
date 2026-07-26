<?php

declare(strict_types=1);

namespace Modules\User\Filament\Admin\Resources\UserResource\Pages;

use Modules\User\Filament\Admin\Resources\UserResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListUserActivities extends ListActivities
{
    protected static string $resource = UserResource::class;
}
