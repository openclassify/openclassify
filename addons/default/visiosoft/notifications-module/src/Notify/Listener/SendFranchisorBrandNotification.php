<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Illuminate\Support\Facades\Notification;
use Visiosoft\FranchModule\Events\FranchisorBrandInfoSent;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;

class SendFranchisorBrandNotification
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

    public function handle(FranchisorBrandInfoSent $event)
    {
        $adminRole = $this->roleRepository->findBySlug('admin');
        $admins = $adminRole->getUsers();

        $mailParams = $event->fields;

        if ($template = $this->templateRepository->findBySlug('franchisor_brand_information_form')) {
            Notification::send($admins, new MailTemplate($template->getTemplateForArray($mailParams)));
        }
    }
}
