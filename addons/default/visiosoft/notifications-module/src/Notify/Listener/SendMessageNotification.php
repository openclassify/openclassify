<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Visiosoft\MessagesModule\Events\MessageCreated;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;

class SendMessageNotification
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

    public function handle(MessageCreated $event)
    {
        $mailParams = [
            'name' => $event->message->created_by->name(),
            'message' => $event->message->detail,
        ];

        if ($template = $this->templateRepository->findBySlug('message_notification')) {
            $event->message->getReceiver()->notify(new MailTemplate($template->getTemplateForArray($mailParams)));
        }

        if ($template = $this->templateRepository->findBySlug('sender_message_notification')) {
            $event->message->created_by->notify(new MailTemplate($template->getTemplateForArray($mailParams)));
        }
    }
}
