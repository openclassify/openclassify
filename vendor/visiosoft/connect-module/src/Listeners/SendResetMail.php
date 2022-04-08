<?php namespace Visiosoft\ConnectModule\Listeners;

use Visiosoft\ConnectModule\Events\ResetPassword;
use Visiosoft\ConnectModule\Notification\ResetYourPassword;

class SendResetMail
{
    public function handle(ResetPassword $event)
    {
        $user = $event->getUser();
        $url = $event->getURL();

        $user->notify(new ResetYourPassword($url));

    }
}
