<?php namespace Visiosoft\NotificationsModule\Listeners;

use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SiteModule\Domain\Event\CreatedDomain;

class AddedDomainSiteAdminMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(CreatedDomain $event)
    {
        $site = $event->getSite();
        $domain = $event->getDomain();

        $template = $this->template->findBySlug(Str::slug('Added Domain Site(Admin)', '_'));

        $mail_params = [
            'url' => $site->getUrl(),
            'domain' => $domain->getDomain(),
        ];

        if ($template) {
            Notification::send(get_admins(), new MailTemplate($template->getTemplateForArray($mail_params)));
        }
    }
}
