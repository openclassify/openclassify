<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SubscriptionsModule\Subscription\Event\CreateSubscriptionOnManuel;

class CreatedSubscriptionOnManuel
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(CreateSubscriptionOnManuel $event)
    {
        $subscription = $event->getSubscription();
        if ($user = $subscription->assign) {

            $template = $this->template->findBySlug(str_slug('Created Subscription On Manuel', '_'));

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
