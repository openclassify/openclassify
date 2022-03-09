<?php namespace Anomaly\UsersModule\User\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

/**
 * Class UserHasBeenActivated
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UserHasBeenActivated extends Notification implements ShouldQueue
{

    use Queueable;

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
        $data = $notifiable->toArray();

        return (new MailMessage())
            ->view('anomaly.module.users::notifications.user_has_been_activated')
            ->subject(trans('anomaly.module.users::notification.user_has_been_activated.subject', $data))
            ->greeting(trans('anomaly.module.users::notification.user_has_been_activated.greeting', $data))
            ->line(trans('anomaly.module.users::notification.user_has_been_activated.instructions', $data))
            ->action(
                trans('anomaly.module.users::notification.user_has_been_activated.button', $data),
                route('anomaly.module.users::login')
            );
    }
}
