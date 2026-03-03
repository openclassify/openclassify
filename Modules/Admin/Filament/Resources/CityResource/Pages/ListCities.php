<?php
namespace Modules\Admin\Filament\Resources\CityResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Admin\Filament\Resources\CityResource;

class ListCities extends ListRecords
{
    protected static string $resource = CityResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
