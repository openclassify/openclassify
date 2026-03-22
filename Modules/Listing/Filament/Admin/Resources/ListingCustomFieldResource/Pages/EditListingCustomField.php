<?php

namespace Modules\Listing\Filament\Admin\Resources\ListingCustomFieldResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Listing\Filament\Admin\Resources\ListingCustomFieldResource;

class EditListingCustomField extends EditRecord
{
    protected static string $resource = ListingCustomFieldResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
