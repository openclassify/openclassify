<?php
namespace Modules\Partner\Filament\Resources\ListingResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Partner\Filament\Resources\ListingResource;

class EditListing extends EditRecord
{
    protected static string $resource = ListingResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
