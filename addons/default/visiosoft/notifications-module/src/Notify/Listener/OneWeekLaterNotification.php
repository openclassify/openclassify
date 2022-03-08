<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Visiosoft\NotificationsModule\Notify\Notification\OneWeekLaterSubscriptionMail;
use Visiosoft\SubscriptionsModule\Subscription\Event\OneWeekLater;

class OneWeekLaterNotification
{
    public function handle(OneWeekLater $event)
    {
        $event->request['user']->notify(new OneWeekLaterSubscriptionMail($event->request['user'],$event->request['subdomain']));
    }
}


