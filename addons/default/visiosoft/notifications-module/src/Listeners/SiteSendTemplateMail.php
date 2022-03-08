<?php namespace Visiosoft\NotificationsModule\Listeners;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\SiteModule\Site\Event\SendEmailTemplate;

class SiteSendTemplateMail
{
    private $template;

    public function __construct(TemplateRepositoryInterface $template)
    {
        $this->template = $template;
    }

    public function handle(SendEmailTemplate $event)
    {
        $user = $event->getSite()->getUser();

        $params = $user->toArray();
        $params['name'] = $user->name();

        $template = $this->template->findBySlug($event->getSlug());
        if ($template) {
            $user->notify(new MailTemplate($template->getTemplateForArray($params)));
        }
    }
}
