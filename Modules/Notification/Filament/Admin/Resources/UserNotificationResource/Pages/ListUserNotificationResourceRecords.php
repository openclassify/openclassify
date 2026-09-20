<?php

declare(strict_types=1);

namespace Modules\Notification\Filament\Admin\Resources\UserNotificationResource\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Modules\Notification\Filament\Admin\Resources\UserNotificationResource;

class ListUserNotificationResourceRecords extends ListRecords
{
    protected static string $resource = UserNotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
