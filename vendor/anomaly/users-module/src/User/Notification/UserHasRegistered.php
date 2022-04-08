<?php namespace Anomaly\UsersModule\User\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;

/**
 * Class UserHasRegistered
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UserHasRegistered extends Notification implements ShouldQueue
{

    use Queueable;

    /**
     * The user who registered.
     *
     * @var UserInterface
     */
    public $user;

    /**
     * Create a new UserHasRegistered instance.
     *
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return ['mail', 'slack'];
    }

    /**
     * Return the mail message.
     *
     * @param AnonymousNotifiable $notifiable
     * @return MailMessage
     */
    public function toMail(AnonymousNotifiable $notifiable)
    {
        $data = $this->user->toArray();

        return (new MailMessage())
            ->view('anomaly.module.users::notifications.user_has_registered')
            ->subject(trans('anomaly.module.users::notification.user_has_registered.subject', $data))
            ->line(trans('anomaly.module.users::notification.user_has_registered.instructions', $data))
            ->action(
                trans('anomaly.module.users::notification.user_has_registered.button', $data),
                $this->user->route('view')
            );
    }

    /**
     * Return the slack message.
     *
     * @param UserInterface $notifiable
     *
     * @return SlackMessage
     */
    public function toSlack(UserInterface $notifiable)
    {
        return (new SlackMessage())
            ->success()
            ->content('Hmm.. What\'s Ryan up to?')
            ->attachment(
                function ($attachment) {
                    $attachment
                        ->title('Testing out teh goodies!', 'http://pyrocms.com/')
                        ->fields(
                            [
                                'Username' => $this->user->getUsername(),
                                'Eamil'    => $this->user->getEmail(),
                            ]
                        );
                }
            );
    }

    /**
     * Return the array storage data.
     *
     * @param Notifiable $notifiable
     *
     * @return array
     */
    public function toDatabase(UserInterface $notifiable)
    {
        return [
            'user' => $this->user,
        ];
    }
}
