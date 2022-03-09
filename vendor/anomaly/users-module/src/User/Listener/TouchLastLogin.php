<?php namespace Anomaly\UsersModule\User\Listener;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\Event\UserWasLoggedIn;

/**
 * Class TouchLastLogin
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TouchLastLogin
{

    /**
     * The user repository.
     *
     * @var UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new TouchLastLogin instance.
     *
     * @param UserRepositoryInterface $users
     */
    public function __construct(UserRepositoryInterface $users)
    {
        $this->users = $users;
    }

    /**
     * Handle the event.
     *
     * @param UserWasLoggedIn $event
     */
    public function handle(UserWasLoggedIn $event)
    {
        $this->users->touchLastLogin($event->getUser());
    }
}
