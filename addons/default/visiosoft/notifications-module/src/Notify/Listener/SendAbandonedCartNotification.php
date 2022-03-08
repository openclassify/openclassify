<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Visiosoft\CartsModule\Cart\Event\CartAbandoned;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;

class SendAbandonedCartNotification
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

    public function handle(CartAbandoned $event)
    {
        $mailParams = [
            'url' => $event->getUrl(),
        ];

        if ($template = $this->templateRepository->findBySlug('abandoned_cart')) {
            $event->getUser()->notify(new MailTemplate($template->getTemplateForArray($mailParams)));
        }
    }
}
