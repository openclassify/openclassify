<?php

declare(strict_types=1);

namespace Modules\Listing\Filament\Admin\Resources\ListingCustomFieldResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Listing\Filament\Admin\Resources\ListingCustomFieldResource;

class CreateListingCustomField extends CreateRecord
{
    protected static string $resource = ListingCustomFieldResource::class;
}
