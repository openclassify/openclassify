<?php namespace Anomaly\UsersModule\User\Validation;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\UserAuthenticator;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class ValidateAuthentication
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ValidateAuthentication
{

    /**
     * Handle the validation.
     *
     * @param UserAuthenticator $authenticator
     * @param Guard             $auth
     * @param                   $value
     * @return UserInterface|bool
     */
    public function handle(UserAuthenticator $authenticator, Guard $auth, $value)
    {
        /* @var UserInterface $user */
        $user = $auth->user();

        return $authenticator->attempt(
            [
                'email'    => $user->getEmail(),
                'password' => $value,
            ]
        );
    }
}
