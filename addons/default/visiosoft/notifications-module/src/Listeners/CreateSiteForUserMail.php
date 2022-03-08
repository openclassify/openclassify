<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\ProfileModule\Events\UserActivatedByMail;
use Visiosoft\SiteModule\Site\Contract\SiteRepositoryInterface;

class CreateSiteForUserMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(UserActivatedByMail $event)
    {
        if (is_module_installed('visiosoft.module.site')) {

            $siteRepository = app(SiteRepositoryInterface::class);
            if ($user = $event->getUser() and $site = $siteRepository->getSitesByAssign($user->getId())->first()) {
                $template = $this->template->findBySlug(str_slug('Login Information', '_'));

                $mail_params = [
                    'display_name' => $user->name(),
                    'email' => $user->getEmail(),
                    'password' => $site->getPassword(),
                    'login_url' => $site->getUrl() . "/admin",
                    'site_url' => $site->getUrl()
                ];

                if (!is_null($template)) {
                    $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
                }
            }
        }
    }
}
