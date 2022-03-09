<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\AdvsModule\Support\Command\Currency;
use Visiosoft\CartsModule\Cart\Event\Payment;
use Visiosoft\NotificationsModule\Notify\NotifyModel;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\OrdersModule\Order\Contract\OrderRepositoryInterface;

class PaySuccess
{
    protected $optionConfigurationRepository;

    public function __construct(
        Dispatcher $events,
        OrderRepositoryInterface $orderRepository,
        UserRepositoryInterface $userRepository,
        TemplateRepositoryInterface $templateRepository,
        RoleRepositoryInterface $roleRepository,
        OptionConfigurationRepositoryInterface $optionConfigurationRepository,
        Currency $currency,
        AdvRepositoryInterface $advRepository
    )
    {
        $this->events = $events;
        $this->model = new NotifyModel();
        $this->orderRepository = $orderRepository;
        $this->user = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->optionConfigurationRepository = $optionConfigurationRepository;
        $this->advRepository = $advRepository;
        $this->template = $templateRepository;
        $this->currency = $currency;
    }

    public function handle(Payment $event)
    {
        if ($order = $this->orderRepository->find($event->getOrderID())) {

            if ($user = $this->user->find($order->user_id)) {
                $adminRole = $this->roleRepository->findBySlug('admin');
                $admins = $adminRole->getUsers();
                $users = $admins->add($user);

                $order_items = $order->details()->get();

                foreach ($order_items as $detail) {
                    if (($detail->item_type === 'adv') && ($adv = $this->advRepository->find($detail->item_id))) {
                        if (!$users->find($adv->created_by)) {
                            $users->add($adv->created_by);
                        }
                    } else if (($detail->item_type === 'ads-configuration') &&
                        ($conf = $this->optionConfigurationRepository->find($detail->item_id)) &&
                        $adv = $conf->parent_adv) {
                        if (!$users->find($adv->created_by)) {
                            $users->add($adv->created_by);
                        }
                    }
                }

                $items = '';
                foreach ($order_items as $detail) {
                    $items .= "{$detail->getDetailName(false)}: {$this->currency->format($detail->price, $detail->currency)}<br><br>";
                }

                if ($template = $this->template->findBySlug('order_created')) {
                    foreach ($users as $mailableUser) {
                        $mail_params = [
                            'display_name' => $mailableUser->name(),
                            'url' => route('orders::purchase_detail', ['id' => $order->id]),
                            'order_id' => $order->id,
                            'items' => $items,
                            'delivery' => $order->delivery_address_content,
                            'billing' => $order->bill_address_content,
                        ];

                        $mailableUser->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
                    }
                }
            }
        }
    }
}
