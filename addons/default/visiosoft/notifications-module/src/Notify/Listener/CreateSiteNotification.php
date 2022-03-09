<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Visiosoft\CloudsiteModule\Site\Event\CreateSite;
use Visiosoft\NotificationsModule\Notify\Notification\CreateSiteMail;

class CreateSiteNotification
{
    public function __construct(SettingRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }
    public function handle(CreateSite $event)
    {
        $event->request['user']->notify(new CreateSiteMail($event->request['user'],$event->request['subdomain']));
    }
}


