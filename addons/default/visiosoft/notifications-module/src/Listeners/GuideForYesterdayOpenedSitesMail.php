<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SiteModule\Site\Event\GuideForYesterdayOpenedSites;

class GuideForYesterdayOpenedSitesMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(GuideForYesterdayOpenedSites $event)
    {
        $site = $event->getSite();
        if ($user = $event->getUser()) {
            $template = $this->template->findBySlug('guide_for_site');

            $mail_params = [
                'site_url' => $site->subdomain_name . "." . $site->type
            ];

            if (!is_null($template)) {

                try {
                    $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
                    return true;
                } catch (\Exception $exception) {
                    return false;
                }
            }
        }

    }
}
