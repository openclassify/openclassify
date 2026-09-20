<?php

declare(strict_types=1);

namespace Modules\Location\Filament\Admin\Resources\DistrictResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Location\Filament\Admin\Resources\DistrictResource;

class CreateDistrict extends CreateRecord
{
    protected static string $resource = DistrictResource::class;
}
