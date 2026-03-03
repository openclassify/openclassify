<?php
namespace Modules\Admin\Filament\Resources\DistrictResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Admin\Filament\Resources\DistrictResource;

class ListDistricts extends ListRecords
{
    protected static string $resource = DistrictResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
