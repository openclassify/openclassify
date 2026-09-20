<?php

declare(strict_types=1);

namespace Modules\Location\Filament\Admin\Resources\CityResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Location\Filament\Admin\Resources\CityResource;

class CreateCity extends CreateRecord
{
    protected static string $resource = CityResource::class;
}
