<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\ReferencesModule\Events\ReferencedUserWasCreated;

class SendReferenceNotification
{
    private $roleRepository;
    private $templateRepository;

    public function __construct(
        RoleRepositoryInterface $roleRepository,
        TemplateRepositoryInterface $templateRepository
    )
    {
        $this->roleRepository = $roleRepository;
        $this->templateRepository = $templateRepository;
    }

    public function handle(ReferencedUserWasCreated $event)
    {
        $mailParams = [
            'referenced_name' => $event->getReference()->user->name(),
            'reference_name' => $event->getReference()->referenced_user->name(),
            'activation_link' => $event->getActivationLink(),
            'site' => setting_value('streams::domain'),
            'password' => $event->getPassword(),
        ];

        if ($template = $this->templateRepository->findBySlug('reference_notification')) {
            $event->getReference()->user->notify(new MailTemplate($template->getTemplateForArray($mailParams)));
        }
    }
}
