<?php namespace Anomaly\UsersModule\User\Password\Command;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;

/**
 * Class InvalidatePassword
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class InvalidatePassword
{

    /**
     * The user interface.
     *
     * @var UserInterface|EloquentModel
     */
    protected $user;

    /**
     * Create a new InvalidatePassword instance.
     *
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the command.
     *
     * @param UserRepositoryInterface $users
     */
    public function handle(UserRepositoryInterface $users)
    {
        $users->save($this->user->setAttribute('password', str_random(32)));
    }
}
