<?php namespace Visiosoft\NotificationsModule\Notify\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;


class SendUserPasswordMail extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;
    private $password;

    /**
     * CreateBookingMail constructor.
     * @param $detail
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

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
        $notifiable->email = $this->user->email;

        return (new MailMessage())
            ->view('visiosoft.module.notifications::notification')
            ->subject(trans('visiosoft.module.booking::messages.user_password_mail_subject'))
            ->greeting(trans('visiosoft.module.notifications::notification.hi_message') . $this->user->display_name)
            ->line('<hr>')
            ->line(trans('visiosoft.module.booking::messages.user_password_mail_message'))
            ->line('<h1 style="text-align: center">' . $this->password . "</h1>")
            ->salutation(trans('visiosoft.module.notifications::notification.thanks_message'))
            ->action(trans('visiosoft.module.booking::messages.user_password_mail_button_text'), url('/login'));
    }
}
