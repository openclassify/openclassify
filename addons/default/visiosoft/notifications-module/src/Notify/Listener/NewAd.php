<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Illuminate\Support\Facades\Auth;
use Visiosoft\AdvsModule\Adv\Event\CreateAd;
use Visiosoft\NotificationsModule\Notify\Notification\NewAdAdminMail;
use Visiosoft\NotificationsModule\Notify\Notification\NewAdUserMail;
use Visiosoft\NotificationsModule\Notify\NotifyModel;
use Illuminate\Contracts\Events\Dispatcher;
use Visiosoft\NotificationsModule\Smsnotify\Event\NewAdSms;


class NewAd
{
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
        $this->model = new NotifyModel();
    }

    public function handle(CreateAd $event)
    {
        $ad_id = $event->request;
        $ad = $this->model->getAd($ad_id);
        $user = $this->model->getUser($ad->created_by_id);

        if ($event->settings->value('visiosoft.module.notifications::user_notifications') == true) {
            $user->notify(new NewAdUserMail($ad, $user, $event->settings));
        }
        if ($event->settings->value('visiosoft.module.notifications::admin_notifications') == true) {
            $user = Auth::user();
            $user->notify(new NewAdAdminMail($ad, $user, $event->settings));
        }

        if ($event->settings->value('visiosoft.module.notifications::new_ad_user_sms') == true) {
            $user = Auth::user();
            $msg = $event->settings->value('visiosoft.module.notifications::new_ad_user_sms_msg');
            $this->events->dispatch(new NewAdSms($user,$msg));
        }
    }
}
