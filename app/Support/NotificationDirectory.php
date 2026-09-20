<?php

declare(strict_types=1);

namespace App\Support;

use Modules\Notification\Models\UserNotification;

final class NotificationDirectory
{
    public static function unreadCountForUser(int $userId): int
    {
        return UserNotification::unreadCountForUser($userId);
    }
}
