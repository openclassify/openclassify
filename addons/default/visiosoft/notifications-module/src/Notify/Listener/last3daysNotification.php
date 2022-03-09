<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Visiosoft\NotificationsModule\Notify\Notification\Last3daysSubscriptionMail;
use Visiosoft\SubscriptionsModule\Subscription\Event\last3days;

class last3daysNotification
{
    public function handle(last3days $event)
    {
        $event->request['user']->notify(new Last3daysSubscriptionMail($event->request['user'],$event->request['subdomain']));
    }
}


