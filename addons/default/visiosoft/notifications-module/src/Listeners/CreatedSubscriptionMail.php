<?php namespace Visiosoft\NotificationsModule\Listeners;

use Illuminate\Support\Str;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SubscriptionsModule\Subscription\Event\CreatedSubscription;

class CreatedSubscriptionMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(CreatedSubscription $event)
    {
        if($user = $event->getSubscription()->assign)
        {
            $subscription = $event->getSubscription();

            $template = $this->template->findBySlug(Str::slug('Created Subscription', '_'));

            $mail_params = [
                'display_name' => $user->name(),
                'subscription_name' => $subscription->getPlan()->getName(),
            ];

            if (!is_null($template)) {
                $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
            }
        }
    }
}
