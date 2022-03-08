<?php namespace Visiosoft\NotificationsModule\Notify\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Visiosoft\OrdersModule\Orderdetail\Contract\OrderdetailInterface;


class StatusAdAdminMail extends Notification implements ShouldQueue
{

    use Queueable;

    /**
     * Redirect here after activating.
     *
     * @var string
     */
    public $ad;
    public $user;
    public $settings;

    /**
     * Create a new UserHasRegistered instance.
     *
     * @param $redirect
     */
    public function __construct($ad, $user, $settings)
    {
        $this->ad = $ad;
        $this->user = $user;
        $this->settings = $settings;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  UserInterface $notifiable
     * @return array
     */
    public function via(UserInterface $notifiable)
    {
        return ['mail'];
    }

    /**
     * Return the mail message.
     *
     * @param  UserInterface $notifiable
     * @return MailMessage
     */
    public function toMail(UserInterface $notifiable)
    {
        if ($this->ad->status == "approved") {
            $subject = trans('visiosoft.module.notifications::notification.active_ad_user_message_subject');
            $line1 = trans('visiosoft.module.notifications::notification.active_ad_user_message_line1');
        } elseif ($this->ad->status == "passive") {
            $subject = trans('visiosoft.module.notifications::notification.passive_ad_user_message_subject');
            $line1 = trans('visiosoft.module.notifications::notification.passive_ad_user_message_line1');
        } elseif ($this->ad->status == "declined") {
            $subject = trans('visiosoft.module.notifications::notification.declined_ad_user_message_subject');
            $line1 = trans('visiosoft.module.notifications::notification.declined_ad_user_message_line1');
        } else {
            $subject = trans('visiosoft.module.notifications::notification.pending_ad_user_message_subject');
            $line1 = trans('visiosoft.module.notifications::notification.pending_ad_user_message_line1');
        }

        return (new MailMessage())
            ->view('visiosoft.module.notifications::notification')
            ->subject($subject)
            ->greeting(trans('visiosoft.module.notifications::notification.hi_message') . $this->user->display_name)
            ->line("\"<font color='black'>" . $this->ad->name . "</font>\"")
            ->line($line1)
            ->salutation(trans('visiosoft.module.notifications::notification.thanks_message'));

    }
}
