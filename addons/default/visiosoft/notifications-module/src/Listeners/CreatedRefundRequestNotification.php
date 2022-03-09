<?php namespace Visiosoft\NotificationsModule\Listeners;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\AdvsModule\Support\Command\Currency;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\OrdersModule\Orderdetail\Contract\OrderdetailRepositoryInterface;
use Visiosoft\OrdersModule\RefundRequest\Events\CreatedRefundRequest;

class CreatedRefundRequestNotification
{
    private $template;
    private $user;
    private $roleRepository;
    private $advRepository;
    private $orderdetailRepository;
    private $optionConfigurationRepository;
    private $currency;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
        UserRepositoryInterface $user,
        TemplateRepositoryInterface $template,
        AdvRepositoryInterface $advRepository,
        OrderdetailRepositoryInterface $orderdetailRepository,
        OptionConfigurationRepositoryInterface $optionConfigurationRepository,
        Currency $currency
    )
    {
        $this->roleRepository = $roleRepository;
        $this->template = $template;
        $this->user = $user;
        $this->advRepository = $advRepository;
        $this->orderdetailRepository = $orderdetailRepository;
        $this->optionConfigurationRepository = $optionConfigurationRepository;
        $this->currency = $currency;
    }

    public function handle(CreatedRefundRequest $event)
    {
        $refund = $event->getRefundEntry();

        if ($user = $this->user->find($refund->created_by_id)) {

            //Set Admins
            $adminRole = $this->roleRepository->findBySlug('admin');
            $admins = $adminRole->getUsers();

            $order_detail = $refund->order_detail;

            //Set Ad
            $model = $this->advRepository;
            if ($order_detail->item_type == "ads-configuration") {
                $model = app(OptionConfigurationRepositoryInterface::class);
                $adv_configration = $model->newQuery()->find($order_detail->item_id);
                $adv = $adv_configration->parent_adv;
            } else {
                $adv = $model->newQuery()->find($order_detail->item_id);
            }

            //Set Seller
            $seller = $this->user->newQuery()->find($adv->created_by_id);

            $mail_params = [
                'seller_order_url' => route('orders::sale_detail', ['id' => $order_detail->order_id]),
                'admin_refund_url' => url('/admin/orders/refund_request/edit/'.$refund->id),
                'order_url' => route('orders::purchase_detail', ['id' => $order_detail->order_id]),
                'ad_url' => route("adv_detail", [$adv->id]),
                'ad_name' => $adv->name,
            ];

            //Send Admins
            foreach ($admins as $admin) {
                if ($template = $this->template->findBySlug('created_refund_notification_for_admin')) {
                    $admin->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
                }
            }

            //Send Seller
            if ($template = $this->template->findBySlug('created_refund_notification_for_seller')) {
                $seller->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
            }

            //Send User
            if ($template = $this->template->findBySlug('created_refund_notification_for_user')) {
                $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
            }
        }
    }
}
