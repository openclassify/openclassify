<?php namespace Anomaly\UsersModule\User\Listener;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Contracts\Auth\Guard;
use Laravel\Scout\Searchable;

/**
 * Class TouchLastActivity
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TouchLastActivity
{

    /**
     * The auth utility.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The user repository.
     *
     * @var UserRepositoryInterface
     */
    protected $users;

    /**
     * Create a new TouchLastActivity instance.
     *
     * @param Guard                   $auth
     * @param UserRepositoryInterface $users
     */
    public function __construct(Guard $auth, UserRepositoryInterface $users)
    {
        $this->auth  = $auth;
        $this->users = $users;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        /* @var UserInterface|Searchable $user */
        if ($user = $this->auth->user()) {
            $user::withoutSyncingToSearch(
                function () use ($user) {
                    $this->users->touchLastActivity($user);
                }
            );
        }
    }
}
