<?php

namespace Modules\Listing\Filament\Admin\Resources\ListingCustomFieldResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Listing\Filament\Admin\Resources\ListingCustomFieldResource;

class ListListingCustomFields extends ListRecords
{
    protected static string $resource = ListingCustomFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
