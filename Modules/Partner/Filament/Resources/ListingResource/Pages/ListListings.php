<?php
namespace Modules\Partner\Filament\Resources\ListingResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Partner\Filament\Resources\ListingResource;

class ListListings extends ListRecords
{
    protected static string $resource = ListingResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
