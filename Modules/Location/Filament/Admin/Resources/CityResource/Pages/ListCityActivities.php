<?php

declare(strict_types=1);

namespace Modules\Location\Filament\Admin\Resources\CityResource\Pages;

use Modules\Location\Filament\Admin\Resources\CityResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListCityActivities extends ListActivities
{
    protected static string $resource = CityResource::class;
}
