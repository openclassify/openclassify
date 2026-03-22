<?php

namespace Modules\Listing\Filament\Admin\Resources\ListingResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Listing\Filament\Admin\Resources\ListingResource;

class CreateListing extends CreateRecord
{
    protected static string $resource = ListingResource::class;
}
