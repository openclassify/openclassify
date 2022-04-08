<?php namespace Anomaly\UsersModule\User\Event;

use Anomaly\UsersModule\User\Contract\UserInterface;

/**
 * Class UserWasKickedOut
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UserWasKickedOut
{

    /**
     * The user object.
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * The reason code the
     * user was kicked out.
     *
     * @var string
     */
    protected $reason;

    /**
     * Create a new UserWasKickedOut instance.
     *
     * @param UserInterface $user
     * @param               $reason
     */
    function __construct(UserInterface $user, $reason)
    {
        $this->user   = $user;
        $this->reason = $reason;
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

    /**
     * Get the reason.
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }
}
