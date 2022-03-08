<?php namespace Visiosoft\NotificationsModule\Notify\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class UserUpdateEmailMail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @param UserInterface $notifiable
     * @return array
     */
    public function via(UserInterface $notifiable)
    {
        return ["mail"];
    }

    /**
     * @param UserInterface $notifiable
     * @return MailMessage
     */
    public function toMail(UserInterface $notifiable)
    {
        return (new MailMessage())
            ->view('visiosoft.module.notifications::notification')
            ->subject(trans('visiosoft.module.profile::message.update_email_mail_subject'))
            ->greeting(trans('visiosoft.module.notifications::notification.hi_message') . auth()->user()->name())
            ->line('<hr>')
            ->line(trans('visiosoft.module.profile::message.update_email_mail_message'))
            ->salutation(trans('visiosoft.module.notifications::notification.thanks_message'));
    }
}
