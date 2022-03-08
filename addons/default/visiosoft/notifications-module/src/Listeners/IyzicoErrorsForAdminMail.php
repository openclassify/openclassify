<?php namespace Visiosoft\NotificationsModule\Listeners;

use Illuminate\Support\Facades\Notification;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;
use Visiosoft\PaymentIyzicoModule\Events\IyzicoErrors;

class IyzicoErrorsForAdminMail
{

    private $template;

    public function __construct(TemplateRepositoryInterface $templateRepository)
    {
        $this->template = $templateRepository;
    }

    public function handle(IyzicoErrors $event)
    {
        $template = $this->template->findBySlug('iyzico_errors_for_admin');

        $mail_params = [
            'message' => $event->getMessage(),
            'entry_title' => ($entry = $event->getEntry()) ? $entry->name : '-',
            'entry_url' => ($entry = $event->getEntry()) ? url('advs/adv/' . $entry->id) : '-',
            'auth_email' => ($user = $event->getAuthUser()) ? $user->email : '-',
        ];

        if ($template) {
            Notification::send(get_admins(), new MailTemplate($template->getTemplateForArray($mail_params)));
        }
    }
}
