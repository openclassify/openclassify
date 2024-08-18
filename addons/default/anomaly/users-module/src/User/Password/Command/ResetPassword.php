<?php namespace Anomaly\UsersModule\User\Password\Command;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;


/**
 * Class ResetPassword
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ResetPassword
{

    /**
     * The user instance.
     *
     * @var UserInterface|EloquentModel
     */
    protected $user;

    /**
     * The password reset code.
     *
     * @var string
     */
    protected $code;

    /**
     * The password desired.
     *
     * @var string
     */
    protected $password;

    /**
     * Create a new ResetPasswordReset instance.
     *
     * @param UserInterface $user
     * @param               $code
     * @param               $password
     */
    function __construct(UserInterface $user, $code, $password)
    {
        $this->user     = $user;
        $this->code     = $code;
        $this->password = $password;
    }

    /**
     * Handle the command.
     *
     * @param  UserRepositoryInterface $users
     * @return bool
     */
    public function handle(UserRepositoryInterface $users)
    {
        $user = $users->findByResetCode($this->code);

        if (!$user) {
            return false;
        }

        if ($user->getId() !== $this->user->getId()) {
            return false;
        }

        $this->user->setAttribute('reset_code', null);
        $this->user->setAttribute('password', $this->password);

        $users->save($this->user);

        return true;
    }
}
