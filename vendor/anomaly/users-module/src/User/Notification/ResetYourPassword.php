<?php namespace Anomaly\UsersModule\User\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

/**
 * Class ResetYourPassword
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ResetYourPassword extends Notification implements ShouldQueue
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
            ->view('anomaly.module.users::notifications.reset_your_password')
            ->subject(trans('anomaly.module.users::notification.reset_your_password.subject', $data))
            ->greeting(trans('anomaly.module.users::notification.reset_your_password.greeting', $data))
            ->line(trans('anomaly.module.users::notification.reset_your_password.notice', $data))
            ->line(trans('anomaly.module.users::notification.reset_your_password.warning', $data))
            ->line(trans('anomaly.module.users::notification.reset_your_password.instructions', $data))
            ->action(
                trans('anomaly.module.users::notification.reset_your_password.button', $data),
                $notifiable->route('reset', ['redirect' => $this->redirect])
            );
    }
}
