<?php

declare(strict_types=1);

namespace Modules\Notification\Filament\Admin\Resources\UserNotificationResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Notification\Filament\Admin\Resources\UserNotificationResource;

class CreateUserNotificationResourceRecord extends CreateRecord
{
    protected static string $resource = UserNotificationResource::class;
}
