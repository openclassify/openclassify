<?php

declare(strict_types=1);

namespace Modules\Location\Filament\Admin\Resources\CityResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Location\Filament\Admin\Resources\CityResource;

class EditCity extends EditRecord
{
    protected static string $resource = CityResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
