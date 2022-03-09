<?php namespace Visiosoft\NotificationsModule\Listeners;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SubscriptionsModule\Subscription\Event\CreatedSubscription;

class CreatedSubscriptionAdminMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(CreatedSubscription $event)
    {
        $subscription = $event->getSubscription();

        $template = $this->template->findBySlug(Str::slug('Created Subscription(Admin)', '_'));

        $mail_params = [
            'subscription_name' => $subscription->getPlan()->getName(),
        ];

        if ($template) {
            Notification::send(get_admins(), new MailTemplate($template->getTemplateForArray($mail_params)));
        }
    }
}
