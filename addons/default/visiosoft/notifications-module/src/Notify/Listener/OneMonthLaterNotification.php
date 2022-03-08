<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Visiosoft\NotificationsModule\Notify\Notification\OneMonthLaterSubscriptionMail;
use Visiosoft\SubscriptionsModule\Subscription\Event\OneMonthLater;

class OneMonthLaterNotification
{
    public function handle(OneMonthLater $event)
    {
        $event->request['user']->notify(new OneMonthLaterSubscriptionMail($event->request['user'],$event->request['subdomain']));
    }
}


