<?php namespace Visiosoft\NotificationsModule\Listeners;

use Illuminate\Support\Str;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SiteModule\Domain\Event\CreatedDomain;

class AddedDomainSiteMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(CreatedDomain $event)
    {
        $site = $event->getSite();
        if ($user = $site->getUser()) {
            $domain = $event->getDomain();

            $template = $this->template->findBySlug(Str::slug('Added Domain Site', '_'));

            $mail_params = [
                'display_name' => $user->name(),
                'url' => $site->getUrl(),
                'domain' => $domain->getDomain(),
            ];

            if (!is_null($template)) {
                $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
            }
        }
    }
}
