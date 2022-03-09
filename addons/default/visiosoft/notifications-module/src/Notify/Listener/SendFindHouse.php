<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Illuminate\Support\Facades\Notification;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;

class SendFindHouse
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

    public function handle(\Visiosoft\HprojectsModule\Events\SendFindHouse $event)
    {
        $template = $this->templateRepository->findBySlug('find_house');

        $mailParams = [
            'name' => $event->info['full_name'],
            'cell_phone' => $event->info['cell_phone'],
            'email' => $event->info['email'],
        ];

        if (!is_null($template)) {
            $adminRole = $this->roleRepository->findBySlug('admin');
            $admins = $adminRole->getUsers();

            Notification::send($admins, new MailTemplate($template->getTemplateForArray($mailParams)));
        }
    }
}
