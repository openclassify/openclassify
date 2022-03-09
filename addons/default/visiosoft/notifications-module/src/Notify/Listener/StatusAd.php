<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Visiosoft\AdvsModule\Adv\Event\ChangeStatusAd;
use Visiosoft\NotificationsModule\Notify\Notification\StatusAdUserMail;
use Visiosoft\NotificationsModule\Notify\NotifyModel;
use Visiosoft\NotificationsModule\Smsnotify\Event\StatusAdSms;

class StatusAd
{
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
        $this->model = new NotifyModel();
    }

    public function handle(ChangeStatusAd $event)
    {
        $ad_id = $event->request;
        $ad = $this->model->getAd($ad_id);
        $user = $this->model->getUser($ad->created_by_id);

        if ($event->settings->value('visiosoft.module.notifications::user_notifications') == true) {
            $user->notify(new StatusAdUserMail($ad, $user, $event->settings));
        }
        if ($event->settings->value('visiosoft.module.notifications::admin_notifications') == true) {
            $user = Auth::user();
            $user->notify(new StatusAdUserMail($ad, $user, $event->settings));
        }
        if ($event->settings->value('visiosoft.module.notifications::status_ad_user_sms') == true) {

            if ($ad->status == "approved") {
                $msg = $event->settings->value('visiosoft.module.notifications::approved_ad_user_sms_msg');
            } elseif ($ad->status == "passive") {
                $msg = $event->settings->value('visiosoft.module.notifications::passive_ad_user_sms_msg');
            } elseif ($ad->status == "declined") {
                $msg = $event->settings->value('visiosoft.module.notifications::declined_ad_user_sms_msg');
            } else {
                $msg = $event->settings->value('visiosoft.module.notifications::pending_ad_user_sms_msg');
            }
            
            $user = Auth::user();
            $this->events->dispatch(new StatusAdSms($user, $msg));
        }
    }
}


