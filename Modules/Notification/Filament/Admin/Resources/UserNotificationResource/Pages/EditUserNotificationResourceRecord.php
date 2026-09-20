<?php

declare(strict_types=1);

namespace Modules\Notification\Filament\Admin\Resources\UserNotificationResource\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Modules\Notification\Filament\Admin\Resources\UserNotificationResource;

class EditUserNotificationResourceRecord extends EditRecord
{
    protected static string $resource = UserNotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
