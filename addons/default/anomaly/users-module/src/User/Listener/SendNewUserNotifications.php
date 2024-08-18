<?php namespace Anomaly\UsersModule\User\Listener;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Event\UserHasRegistered;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Notifications\AnonymousNotifiable;

/**
 * Class SendNewUserNotifications
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SendNewUserNotifications
{

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * Create a new SendNewUserNotifications instance.
     *
     * @param UserInterface $user
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Handle the event.
     *
     * @param UserHasRegistered $event
     */
    public function handle(UserHasRegistered $event)
    {
        $recipients = $this->config->get('anomaly.module.users::notifications.new_user', []);

        foreach ($recipients as $email) {
            (new AnonymousNotifiable)
                ->route('mail', $email)
                ->notify(
                    new \Anomaly\UsersModule\User\Notification\UserHasRegistered(
                        $event->getUser()
                    )
                );
        }
    }
}
