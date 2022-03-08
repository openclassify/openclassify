<?php namespace Visiosoft\NotificationsModule\Listeners;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Support\Command\Currency;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\OrdersModule\Events\OrderCreated;

class OrderCreatedMail
{
    private $template;
    private $user;
    private $roleRepository;
    private $advRepository;
    private $currency;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
        UserRepositoryInterface $user,
        TemplateRepositoryInterface $template,
        AdvRepositoryInterface $advRepository,
        Currency $currency
    )
    {
        $this->roleRepository = $roleRepository;
        $this->template = $template;
        $this->user = $user;
        $this->advRepository = $advRepository;
        $this->currency = $currency;
    }

    public function handle(OrderCreated $event)
    {
        $order = $event->getOrder();
        if ($user = $this->user->find($order->user_id) and $order->pay_type != "iyzico") {
            $adminRole = $this->roleRepository->findBySlug('admin');
            $admins = $adminRole->getUsers();
            $users = $admins->add($user);

            $order_items = $order->details()->get();

            foreach ($order_items as $detail) {
                if (($detail->item_type === 'adv') && ($adv = $this->advRepository->find($detail->item_id))) {
                	if ($detail->seller && !$users->find($detail->seller_id)) {
		                $users->add($detail->seller);
	                } elseif (!$users->find($adv->created_by) && !$users->find($adv->created_by_id)) {
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
