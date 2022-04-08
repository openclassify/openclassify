<?php namespace Visiosoft\ConnectModule\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ResetYourPassword extends Notification implements ShouldQueue
{
    use Queueable;

    public $callback;


    public function __construct($callback = '/')
    {
        $this->callback = $callback;
    }

    public function via(UserInterface $notifiable)
    {
        return ['mail'];
    }

    public function toMail(UserInterface $notifiable)
    {
        $data = $notifiable->toArray();

        return (new MailMessage())
            ->error()
            ->view('anomaly.module.users::notifications.reset_your_password',[])
            ->subject(trans('anomaly.module.users::notification.reset_your_password.subject', $data))
            ->greeting(trans('anomaly.module.users::notification.reset_your_password.greeting', $data))
            ->line(trans('anomaly.module.users::notification.reset_your_password.notice', $data))
            ->line(trans('anomaly.module.users::notification.reset_your_password.warning', $data))
            ->line(trans('anomaly.module.users::notification.reset_your_password.instructions', $data))
            ->action(
                trans('anomaly.module.users::notification.reset_your_password.button', $data),
               $this->callback
            );
    }
}
