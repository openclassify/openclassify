<?php namespace Visiosoft\NotificationsModule\Notify\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Hashids\Hashids;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;


class ActivationBookingMail extends Notification implements ShouldQueue
{
    use Queueable;

    private $detail;

    /**
     * CreateBookingMail constructor.
     * @param $detail
     */
    public function __construct($detail)
    {
        $this->detail = $detail;
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
        $notifiable->email = $this->detail->email;

        $hashIds = new Hashids('V1si@b00k1ng', 5);
        $hashedId = $hashIds->encode($this->detail->id, $this->detail->activation_code);

        return (new MailMessage())
            ->view('visiosoft.module.notifications::notification')
            ->subject(trans('visiosoft.module.booking::messages.activation_mail_subject'))
            ->greeting(trans('visiosoft.module.notifications::notification.hi_message') . $this->detail->name)
            ->line('<hr>')
            ->line(trans('visiosoft.module.booking::messages.activation_mail_message'))
            ->line('<h1 style="text-align: center">' . $this->detail->activation_code . "</h1>")
            ->line('<table style="width: 100%; margin: 30px auto; padding: 0; text-align: center;" align="center" width="100%" cellpadding="0" cellspacing="0">
            <tbody><tr><td align="center"><a target="_blank" rel="noopener noreferrer" href="' . url('/booking/cancel?booking_id=' . $hashedId) . '" style="font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px; background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px; text-align: center; text-decoration: none; -webkit-text-size-adjust: none; background-color: #999999;" class="button">
            ' . trans('visiosoft.module.booking::messages.cancel_mail_button_text') . '</a>
            </td> </tr></tbody></table>')
            ->salutation(trans('visiosoft.module.notifications::notification.thanks_message'))
            ->action(trans('visiosoft.module.booking::messages.activation_mail_button_text'), url('/booking/activated?booking_id=' . $hashedId . "&activation_code=" . $this->detail->activation_code));
    }
}
