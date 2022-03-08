<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SiteModule\Site\Event\installedAddon;

class InstalledAddonMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(installedAddon $event)
    {
        $site = $event->getSite();
        if ($user = $site->getUser()) {
            $addon = $event->getAddon();

            $template = $this->template->findBySlug('installed_addon');

            $mail_params = [
                'display_name' => $user->name(),
                'site_url' => $site->subdomain_name . "." . $site->type,
                'addon_name' => $addon->addon
            ];

            if (!is_null($template)) {
                $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
            }
        }
    }
}
