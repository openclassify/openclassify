<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Visiosoft\NotificationsModule\Notify\Notification\AgainSaleMail;
use Visiosoft\NotificationsModule\Notify\Notification\PaymentOrderMail;
use Visiosoft\NotificationsModule\Notify\Notification\RefundOrderMail;
use Visiosoft\OrdersModule\Orderdetail\Event\AgainSaleOrder;

class RefundOrder
{
    public function __construct(SettingRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }
    public function handle(\Visiosoft\OrdersModule\Orderdetail\Event\RefundOrder $event)
    {
        $user = $event->user;
        $user->notify(new RefundOrderMail($user,$this->settings));

    }
}


