<?php namespace Visiosoft\NotificationsModule\Listeners;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Event\ChangedStatusAd;
use Visiosoft\NotificationsModule\Template\Contract\TemplateRepositoryInterface;
use Visiosoft\NotificationsModule\Template\Notification\MailTemplate;

class ChangeStatusAdMail
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

    public function handle(ChangedStatusAd $event)
    {
        $ad = $event->getAdDetail();
        $user = $this->user->find($ad->created_by_id);
        if ($ad->status == "approved") {
            $template = $this->template->findBySlug('approved_ad');
        } elseif ($ad->status == "declined") {
            $template = $this->template->findBySlug('declined_ad');
        } elseif ($ad->status == "pending_user") {
            $template = $this->template->findBySlug('pending_user_ad');
        } else {
            $template = $this->template->findBySlug('pending_ad');
        }
        if ($user and $template) {
            $user->notify(new MailTemplate($template->getTemplate($ad)));
        }
    }
}
