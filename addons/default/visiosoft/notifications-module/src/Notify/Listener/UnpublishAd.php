<?php namespace Visiosoft\NotificationsModule\Notify\Listener;

use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Auth;
use Visiosoft\NotificationsModule\Notify\Notification\StatusAdUserMail;
use Visiosoft\NotificationsModule\Notify\NotifyModel;
use Visiosoft\NotificationsModule\Smsnotify\Event\UnpublishAdSms;

class UnpublishAd
{
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
        $this->model = new NotifyModel();
    }

    public function handle(UnpublishAd $event)
    {
        $ad_id = $event->request;
        $ad = $this->model->getAd($ad_id);
        $user = $this->model->getUser($ad->created_by_id);

        if ($event->settings->value('visiosoft.module.notifications::user_notifications') == true) {
            $user->notify(new StatusAdUserMail($ad,$user,$event->settings));
        }
        if ($event->settings->value('visiosoft.module.notifications::admin_notifications') == true) {
            $user = Auth::user();
            $user->notify(new StatusAdUserMail($ad,$user,$event->settings));
        }
        if ($event->settings->value('visiosoft.module.notifications::unpublish_ad_user_sms') == true) {
            $user = Auth::user();
            $msg = $event->settings->value('visiosoft.module.notifications::unpublish_ad_user_sms_msg');
            $this->events->dispatch(new UnpublishAdSms($user,$msg));
        }
    }
}


