<?php namespace Anomaly\UsersModule\User\Password\Command;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;


/**
 * Class StartPasswordReset
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class StartPasswordReset
{

    /**
     * The user instance.
     *
     * @var UserInterface|EloquentModel
     */
    protected $user;

    /**
     * Create a new StartPasswordReset instance.
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
     * @param  UserRepositoryInterface $users
     * @return bool
     */
    public function handle(UserRepositoryInterface $users)
    {
        return $users->save($this->user->setAttribute('reset_code', str_random(40)));
    }
}
