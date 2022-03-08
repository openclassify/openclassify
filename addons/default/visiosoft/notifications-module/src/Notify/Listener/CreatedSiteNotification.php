<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Visiosoft\CloudsiteModule\Site\Event\SendNotificationUser;
use Visiosoft\NotificationsModule\Notify\Notification\CreatedSiteMail;

class CreatedSiteNotification
{
    public function __construct(SettingRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }
    public function handle(SendNotificationUser $event)
    {
        $event->request['user']->notify(new CreatedSiteMail($event->request['user'],$event->request['subdomain'],$event->request['loginDetail']));
    }
}


