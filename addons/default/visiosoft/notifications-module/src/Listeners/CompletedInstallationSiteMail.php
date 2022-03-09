<?php namespace Visiosoft\NotificationsModule\Listeners;

use Illuminate\Support\Str;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SiteModule\Site\Event\CompletedInstallationSite;

class CompletedInstallationSiteMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(CompletedInstallationSite $event)
    {
        $site = $event->getSite();
        if($user = $event->getUser())
        {
            $template = $this->template->findBySlug(Str::slug('Completed Installation Site', '_'));

            $mail_params = [
                'display_name' => $user->name(),
                'email' => $user->getEmail(),
                'password' => $site->getPassword(),
                'login_url' => $site->getUrl(). "/admin",
                'site_url' => $site->getUrl()
            ];

            if (!is_null($template)) {
                $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
            }
        }
    }
}
