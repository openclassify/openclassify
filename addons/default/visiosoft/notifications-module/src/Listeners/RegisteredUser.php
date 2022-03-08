<?php namespace Visiosoft\NotificationsModule\Listeners;

use Anomaly\UsersModule\User\Event\UserHasRegistered;
use Visiosoft\NotificationsModule\Notify\Notification\SendEmlak24RegMail;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;

class RegisteredUser
{
    private $template;

    public function __construct(TemplateRepositoryInterface $template)
    {
        $this->template = $template;
    }

    public function handle(UserHasRegistered $event)
    {
        $user = $event->getUser();
        $template = $this->template->findBySlug('registered_user');
        if (!is_null($template)) {
            $user->notify(new MailTemplate($template->getTemplateForArray($user->toArray())));
        }

        if (setting_value('streams::standard_theme') == 'visiosoft.theme.emlak24') {
            $user->notify(new SendEmlak24RegMail($user));
        }
    }
}
