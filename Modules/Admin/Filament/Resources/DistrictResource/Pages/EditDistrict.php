<?php
namespace Modules\Admin\Filament\Resources\DistrictResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Admin\Filament\Resources\DistrictResource;

class EditDistrict extends EditRecord
{
    protected static string $resource = DistrictResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
