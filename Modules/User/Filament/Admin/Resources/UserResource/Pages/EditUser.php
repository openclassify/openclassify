<?php

namespace Modules\User\Filament\Admin\Resources\UserResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\User\Filament\Admin\Resources\UserResource;
use STS\FilamentImpersonate\Actions\Impersonate;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Impersonate::make()->record($this->getRecord()),
            DeleteAction::make(),
        ];
    }
}
