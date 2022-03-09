<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Visiosoft\NotificationsModule\Notify\Notification\AgainSaleMail;
use Visiosoft\OrdersModule\Orderdetail\Event\AgainSaleOrder;

class AgainSale
{
    public function __construct(SettingRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }
    public function handle(AgainSaleOrder $event)
    {
        $buyer_msg = $event->request;
        $seller = $event->seller;
        $seller->notify(new AgainSaleMail($buyer_msg,$seller,$this->settings));

    }
}


