<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SiteModule\Site\Contract\SiteRepositoryInterface;
use Visiosoft\SubscriptionsModule\Subscription\Event\ExpiredSubscription;

class SubscriptionExpiredMail
{

    private $template;
    private $site;

    public function __construct(TemplateRepositoryInterface $templateRepository,SiteRepositoryInterface $site)
    {
        $this->template = $templateRepository;
        $this->site = $site;
    }

    public function handle(ExpiredSubscription $event)
    {
        if($user = $event->getSubscription()->assign)
        {
            $subscription = $event->getSubscription();

            $template = $this->template->findBySlug("subscription_expired");

            $sites = array();
            foreach ($this->site->getSiteForSubscription($subscription->id) as $site) {
                $sites[] = $site->subdomain_name . "." . $site->type;
            }

            $mail_params = [
                'display_name' => $user->display_name,
                'plan_name' => $subscription->plan->name ?? trans('visiosoft.module.notifications::field.unknown'),
                'sites' => implode(',', $sites),
            ];

            if (!is_null($template)) {
                $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
            }
        }
    }
}
