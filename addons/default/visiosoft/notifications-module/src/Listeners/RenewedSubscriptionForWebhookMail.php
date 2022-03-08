<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SubscriptionsModule\Subscription\Event\webhook\SubscriptionRenewedForWebhook;

class RenewedSubscriptionForWebhookMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(SubscriptionRenewedForWebhook $event)
    {
        if ($user = $event->getSubscription()->assign) {
            $subscription = $event->getSubscription();

            $template = $this->template->findBySlug(str_slug('Renewed Subscription For Paddle', '_'));

            $mail_params = [
                'display_name' => $user->display_name,
                'subscription_name' => $subscription->plan->name,
            ];

            if (!is_null($template)) {
                $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
            }
        }
    }
}
