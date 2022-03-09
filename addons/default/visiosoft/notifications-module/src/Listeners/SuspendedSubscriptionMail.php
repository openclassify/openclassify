<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SubscriptionsModule\Subscription\Event\SuspendedSubscription;

class SuspendedSubscriptionMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(SuspendedSubscription $event)
    {
        if ($user = $event->getSubscription()->assign) {
            $subscription = $event->getSubscription();

            $template = $this->template->findBySlug('suspended_subscription');

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
