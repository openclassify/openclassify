<?php namespace Visiosoft\ConnectModule\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ActivateYourAccount extends Notification implements ShouldQueue
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
            ->view('anomaly.module.users::notifications.activate_your_account')
            ->subject(trans('anomaly.module.users::notification.activate_your_account.subject', $data))
            ->greeting(trans('anomaly.module.users::notification.activate_your_account.greeting', $data))
            ->line(trans('anomaly.module.users::notification.activate_your_account.instructions', $data))
            ->action(
                trans('anomaly.module.users::notification.activate_your_account.button', $data),
                $this->callback
            );
    }
}
