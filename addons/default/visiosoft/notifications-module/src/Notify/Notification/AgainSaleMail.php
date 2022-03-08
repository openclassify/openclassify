<?php namespace Visiosoft\NotificationsModule\Notify\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Visiosoft\OrdersModule\Orderdetail\Contract\OrderdetailInterface;


class AgainSaleMail extends Notification implements ShouldQueue
{

    use Queueable;

    /**
     * Redirect here after activating.
     *
     * @var string
     */
    public $user;
    public $settings;
    public $seller_msg;

    /**
     * Create a new UserHasRegistered instance.
     *
     * @param $redirect
     */
    public function __construct($seller_msg,$user,$settings)
    {
        $this->seller_msg = $seller_msg;
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
        $subject = trans('visiosoft.module.notifications::notification.again_sale_user_message_subject');
        $line1 = trans('visiosoft.module.notifications::notification.again_sale_user_message_line');

        return (new MailMessage())
            ->view('visiosoft.module.notifications::notification')
            ->subject($subject)
            ->greeting(trans('visiosoft.module.notifications::notification.hi_message') . $this->user->display_name)
            ->line($line1)
            ->line("\"<font color='black'>" . $this->seller_msg . "</font>\"")
            ->salutation(trans('visiosoft.module.notifications::notification.thanks_message'));
    }
}
