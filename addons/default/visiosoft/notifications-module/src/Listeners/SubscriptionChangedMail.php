<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SubscriptionsModule\Subscription\Event\SubscriptionChanged;
use Visiosoft\SubscriptionsModule\Subscription\Event\SubscriptionCreated;

class SubscriptionChangedMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(SubscriptionChanged $event)
    {
        if ($user = $event->getSubscription()->assign) {
            $subscription = $event->getSubscription();


            $template = $this->template->findBySlug("subscription_changed");

            $mail_params = [
                'display_name' => $user->display_name,
                'plan_name' => $subscription->plan->name,
            ];

            if (!is_null($template)) {
                $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
            }
        }
    }
}
