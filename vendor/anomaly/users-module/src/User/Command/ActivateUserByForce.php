<?php namespace Anomaly\UsersModule\User\Command;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;


/**
 * Class ActivateUserByForce
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ActivateUserByForce
{

    /**
     * The user instance.
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * Create a new ActivateUserByForce instance.
     *
     * @param UserInterface $user
     */
    function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the command.
     *
     * @param  UserRepositoryInterface $users
     * @return bool
     */
    public function handle(UserRepositoryInterface $users)
    {
        $this->user->activated       = true;
        $this->user->activation_code = null;

        $users->save($this->user);

        return true;
    }
}
