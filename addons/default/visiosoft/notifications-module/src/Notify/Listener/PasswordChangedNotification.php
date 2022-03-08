<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\ProfileModule\Events\PasswordChanged;

class PasswordChangedNotification
{
    private $templateRepository;

    public function __construct(
        TemplateRepositoryInterface $templateRepository
    )
    {
        $this->templateRepository = $templateRepository;
    }

    public function handle(PasswordChanged $event)
    {
        if ($template = $this->templateRepository->findBySlug('password_changed')) {
            auth()->user()->notify(new MailTemplate($template->getTemplateForArray()));
        }
    }
}
