<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Visiosoft\NotificationsModule\Notify\Notification\LastdaySubscriptionMail;
use Visiosoft\SubscriptionsModule\Subscription\Event\lastday;

class lastdayNotification
{
    public function handle(lastday $event)
    {
        $event->request['user']->notify(new LastdaySubscriptionMail($event->request['user'],$event->request['subdomain']));
    }
}


