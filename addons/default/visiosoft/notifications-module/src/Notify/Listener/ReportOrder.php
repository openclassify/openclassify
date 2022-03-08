<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Visiosoft\NotificationsModule\Notify\Notification\ReportOrderMail;

class ReportOrder
{
    public function __construct(SettingRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }
    public function handle(\Visiosoft\OrdersModule\Orderdetail\Event\ReportOrder $event)
    {
        $userMsg = $event->request;
        $user = $event->user;
        $user->notify(new ReportOrderMail($userMsg,$user,$this->settings));

    }
}


