<?php namespace Anomaly\UsersModule\User;

use Anomaly\UsersModule\User\Command\ValidatePasswordStrength;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Password\Command\InvalidatePassword;
use Anomaly\UsersModule\User\Password\Command\ResetPassword;
use Anomaly\UsersModule\User\Password\Command\SendInvalidatedEmail;
use Anomaly\UsersModule\User\Password\Command\SendResetEmail;
use Anomaly\UsersModule\User\Password\Command\StartPasswordReset;

/**
 * Class UserPassword
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UserPassword
{
    /**
     * Check if the password passes validation.
     *
     * @param $password
     * @return bool
     */
    public function passes($password)
    {
        return $this->validate($password)->passes();
    }

    /**
     * Validate the password.
     *
     * @param $password
     * @return Validator
     */
    public function validate($password)
    {
        return dispatch_sync(new ValidatePasswordStrength($password));
    }

    /**
     * Start a password reset.
     *
     * @param  UserInterface $user
     * @return bool
     */
    public function forgot(UserInterface $user)
    {
        return dispatch_sync(new StartPasswordReset($user));
    }

    /**
     * Reset a user's password.
     *
     * @param  UserInterface $user
     * @param                $code
     * @param                $password
     * @return bool
     */
    public function reset(UserInterface $user, $code, $password)
    {
        return dispatch_sync(new ResetPassword($user, $code, $password));
    }

    /**
     * Send the reset email.
     *
     * @param  UserInterface $user
     * @param  string        $reset
     * @return bool
     */
    public function send(UserInterface $user, $reset = '/')
    {
        return dispatch_sync(new SendResetEmail($user, $reset));
    }

    /**
     * Invalidate a user password and request reset.
     *
     * @param  UserInterface $user
     * @param  string        $reset
     * @return bool
     */
    public function invalidate(UserInterface $user, $reset = '/')
    {
        $this->forgot($user);
        dispatch_sync(new InvalidatePassword($user));

        return dispatch_sync(new SendInvalidatedEmail($user, $reset));
    }

}
