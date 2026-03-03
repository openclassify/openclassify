<?php
namespace Modules\Admin\Filament\Resources\ListingResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Admin\Filament\Resources\ListingResource;

class ListListings extends ListRecords
{
    protected static string $resource = ListingResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
