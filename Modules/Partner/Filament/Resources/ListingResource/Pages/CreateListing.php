<?php
namespace Modules\Partner\Filament\Resources\ListingResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Partner\Filament\Resources\ListingResource;

class CreateListing extends CreateRecord
{
    protected static string $resource = ListingResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = \Filament\Facades\Filament::auth()->id();
        $data['status'] = 'pending';
        return $data;
    }
}
