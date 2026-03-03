<?php
namespace Modules\Admin\Filament\Resources\LocationResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Admin\Filament\Resources\LocationResource;

class ListLocations extends ListRecords
{
    protected static string $resource = LocationResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
