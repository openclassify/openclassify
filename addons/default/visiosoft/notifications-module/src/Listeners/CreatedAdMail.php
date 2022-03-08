<?php namespace Visiosoft\NotificationsModule\Listeners;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Event\CreatedAd;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;

class CreatedAdMail
{
    private $ad;
    private $template;
    private $user;

    public function __construct(
        AdvModel $ad,
        UserRepositoryInterface $user,
        TemplateRepositoryInterface $template)
    {
        $this->ad = $ad;
        $this->template = $template;
        $this->user = $user;
    }

    public function handle(CreatedAd $event)
    {
        $ad = $event->getAdDetail();
        $user = $this->user->find($ad->created_by_id);

        $template = $this->template->findBySlug('created_ad');
        if (!is_null($template)) {
            $user->notify(new MailTemplate($template->getTemplate($ad)));
        }
    }
}
