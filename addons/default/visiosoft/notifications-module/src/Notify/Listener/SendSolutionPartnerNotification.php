<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Illuminate\Support\Facades\Notification;
use Visiosoft\FranchModule\Events\SolutionPartnerInfoSent;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;

class SendSolutionPartnerNotification
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

    public function handle(SolutionPartnerInfoSent $event)
    {
        $adminRole = $this->roleRepository->findBySlug('admin');
        $admins = $adminRole->getUsers();

        $mailParams = $event->fields->toArray();

        if ($template = $this->templateRepository->findBySlug('solution_partner_information_form')) {
            Notification::send($admins, new MailTemplate($template->getTemplateForArray($mailParams)));
        }
    }
}
