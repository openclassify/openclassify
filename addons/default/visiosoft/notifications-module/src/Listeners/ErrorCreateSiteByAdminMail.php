<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SiteModule\Site\Event\ErrorCreateSite;

class ErrorCreateSiteByAdminMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(ErrorCreateSite $event)
    {
        $site = $event->getSite();
        if($user = $site->assign)
        {
            $template = $this->template->findBySlug(str_slug('Error Create Site By Admin', '_'));

            $mail_params = [
                'display_name' => $user->display_name,
                'url' => $site->subdomain_name . "." . $site->type,
                'message' => $site->message
            ];

            if (!is_null($template)) {
                $user->notify(new MailTemplate($template->getTemplateForArray($mail_params), setting_value('streams::email', 'info@openclassify.com')));
            }
        }
    }
}
