<?php namespace Anomaly\UsersModule\User\Event;

use Anomaly\UsersModule\User\Contract\UserInterface;

/**
 * Class UserWasCreated
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UserWasCreated
{

    /**
     * The user object.
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * Create a new UserWasCreated instance.
     *
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Get the user.
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
}
