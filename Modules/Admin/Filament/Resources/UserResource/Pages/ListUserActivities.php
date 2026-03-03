<?php
namespace Modules\Admin\Filament\Resources\UserResource\Pages;

use Modules\Admin\Filament\Resources\UserResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListUserActivities extends ListActivities
{
    protected static string $resource = UserResource::class;
}
