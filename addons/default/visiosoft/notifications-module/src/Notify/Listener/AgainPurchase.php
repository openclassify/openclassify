<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Visiosoft\NotificationsModule\Notify\Notification\AgainPurchaseMail;
use Visiosoft\OrdersModule\Orderdetail\Event\AgainPurchaseOrder;

class AgainPurchase
{
    public function __construct(SettingRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }
    public function handle(AgainPurchaseOrder $event)
    {
        $buyer_msg = $event->request;
        $buyer = $event->buyer;
        $buyer->notify(new AgainPurchaseMail($buyer_msg,$buyer,$this->settings));

    }
}


