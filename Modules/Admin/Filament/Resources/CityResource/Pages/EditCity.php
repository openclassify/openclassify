<?php
namespace Modules\Admin\Filament\Resources\CityResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Admin\Filament\Resources\CityResource;

class EditCity extends EditRecord
{
    protected static string $resource = CityResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
