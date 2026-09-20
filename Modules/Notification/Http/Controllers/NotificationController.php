<?php

declare(strict_types=1);

namespace Modules\Notification\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Notification\Models\UserNotification;

class NotificationController extends Controller
{
    public function index(Request $request): View
    {
        $userId = (int) $request->user()->getKey();

        return view('notification::index', [
            'notifications' => UserNotification::paginateForUser($userId),
            'unreadCount' => UserNotification::unreadCountForUser($userId),
        ]);
    }

    public function read(Request $request, UserNotification $notification): RedirectResponse
    {
        abort_unless($notification->belongsToUser((int) $request->user()->getKey()), 403);

        $notification->markRead();

        $target = $notification->getAttribute('action_url');

        return is_string($target) && $target !== ''
            ? redirect()->away($target)
            : back();
    }

    public function readAll(Request $request): RedirectResponse
    {
        UserNotification::markAllReadForUser((int) $request->user()->getKey());

        return back()->with('success', __('notification::messages.all_read'));
    }
}
