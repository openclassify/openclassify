<?php namespace Anomaly\UsersModule\User\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

/**
 * Class PasswordInvalidated
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PasswordInvalidated extends Notification implements ShouldQueue
{

    use Queueable;

    /**
     * Redirect here after activating.
     *
     * @var string
     */
    public $redirect;

    /**
     * Create a new UserHasRegistered instance.
     *
     * @param $redirect
     */
    public function __construct($redirect = '/')
    {
        $this->redirect = $redirect;
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
        $data = $notifiable->toArray();

        return (new MailMessage())
            ->error()
            ->view('anomaly.module.users::notifications.password_invalidated')
            ->subject(trans('anomaly.module.users::notification.password_invalidated.subject', $data))
            ->greeting(trans('anomaly.module.users::notification.password_invalidated.greeting', $data))
            ->line(trans('anomaly.module.users::notification.password_invalidated.notice', $data))
            ->line(trans('anomaly.module.users::notification.password_invalidated.warning', $data))
            ->line(trans('anomaly.module.users::notification.password_invalidated.instructions', $data))
            ->action(
                trans('anomaly.module.users::notification.password_invalidated.button', $data),
                $notifiable->route('reset', ['redirect' => $this->redirect])
            );
    }
}
