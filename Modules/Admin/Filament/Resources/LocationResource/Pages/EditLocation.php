<?php
namespace Modules\Admin\Filament\Resources\LocationResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Admin\Filament\Resources\LocationResource;

class EditLocation extends EditRecord
{
    protected static string $resource = LocationResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
