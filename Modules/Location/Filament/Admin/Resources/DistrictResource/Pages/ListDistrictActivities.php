<?php

declare(strict_types=1);

namespace Modules\Location\Filament\Admin\Resources\DistrictResource\Pages;

use Modules\Location\Filament\Admin\Resources\DistrictResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListDistrictActivities extends ListActivities
{
    protected static string $resource = DistrictResource::class;
}
