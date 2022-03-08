<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SiteModule\Site\Event\SuspendedSite;
use Visiosoft\SiteModule\Site\Event\UnSuspendedSite;

class UnSuspendedSiteByAdminMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(UnSuspendedSite $event)
    {
        $site = $event->getSite();

        if ($user = $site->assign) {
            $template = $this->template->findBySlug(str_slug('UnSuspended Site By Admin', '_'));

            $mail_params = [
                'display_name' => $user->display_name,
                'url' => $site->subdomain_name . "." . $site->type,
            ];

            if (!is_null($template)) {
                $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
            }
        }
    }
}
