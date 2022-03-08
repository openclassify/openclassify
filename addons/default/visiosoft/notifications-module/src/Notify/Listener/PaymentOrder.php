<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Visiosoft\NotificationsModule\Notify\Notification\AgainSaleMail;
use Visiosoft\NotificationsModule\Notify\Notification\PaymentOrderMail;
use Visiosoft\OrdersModule\Orderdetail\Event\AgainSaleOrder;

class PaymentOrder
{
    public function __construct(SettingRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }
    public function handle(\Visiosoft\OrdersModule\Orderdetail\Event\PaymentOrder $event)
    {
        $user = $event->user;
        $user->notify(new PaymentOrderMail($user,$this->settings));

    }
}


