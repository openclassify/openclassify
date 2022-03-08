<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SiteModule\Domain\Event\DeletedDomain;

class DeletedDomainSiteMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(DeletedDomain $event)
    {
        $site = $event->getSite();
        if($user = $site->assign)
        {
            $domain = $event->getDomain();

            $template = $this->template->findBySlug(str_slug('Deleted Domain Site', '_'));

            $mail_params = [
                'display_name' => $user->display_name,
                'url' => $site->subdomain_name . "." . $site->type,
                'domain' => $domain->domain,
            ];

            if (!is_null($template)) {
                $user->notify(new MailTemplate($template->getTemplateForArray($mail_params)));
            }
        }
    }
}
