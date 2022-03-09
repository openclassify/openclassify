<?php namespace Visiosoft\NotificationsModule\Listeners;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\OrdersModule\Order\Contract\OrderRepositoryInterface;
use Visiosoft\OrdersModule\Order\Events\AddedTrackingNumber;
use Visiosoft\OrdersModule\Orderdetail\Contract\OrderdetailRepositoryInterface;

class AddedTrackingNumberNotification
{
    private $template;
    private $user;
    private $advRepository;
    private $orderdetailRepository;
    private $optionConfigurationRepository;
    private $orderRepository;

    public function __construct(
        UserRepositoryInterface $user,
        TemplateRepositoryInterface $template,
        AdvRepositoryInterface $advRepository,
        OrderdetailRepositoryInterface $orderdetailRepository,
        OptionConfigurationRepositoryInterface $optionConfigurationRepository,
        OrderRepositoryInterface $orderRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->template = $template;
        $this->user = $user;
        $this->advRepository = $advRepository;
        $this->orderdetailRepository = $orderdetailRepository;
        $this->optionConfigurationRepository = $optionConfigurationRepository;
    }

    public function handle(AddedTrackingNumber $event)
    {
        $order_detail = $event->getOrderDetail();
        if ($order = $this->orderRepository->find($order_detail->order_id) and $user = $this->user->find($order->user_id)) {

            //Set Ad
            if ($order_detail->item_type == "ads-configuration") {
                $adv_configration = $this->optionConfigurationRepository->find($order_detail->item_id);
                $adv = $adv_configration->parent_adv;
            } else {
                $adv = $this->advRepository->find($order_detail->item_id);
            }

            $mail_params = [
                'ad_name' => $adv->name,
                'tracking_number' => $order_detail->tracking_number,
                'tracking_days' => $order_detail->transport_days,
                'tracking_detail_url' => $order_detail->transport_detail_url,
                'order_url' => route('orders::purchase_detail', ['id' => $order_detail->order_id]),
            ];

            if ($template = $this->template->findBySlug('added_tracking_number')) {
                $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
            }
        }
    }
}
