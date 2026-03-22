<?php

namespace Modules\Listing\Filament\Admin\Resources\ListingResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Listing\Filament\Admin\Resources\ListingResource;

class ListListings extends ListRecords
{
    protected static string $resource = ListingResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
