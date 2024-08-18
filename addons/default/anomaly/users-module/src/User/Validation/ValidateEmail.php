<?php namespace Anomaly\UsersModule\User\Validation;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;

/**
 * Class ValidateEmail
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ValidateEmail
{

    /**
     * Handle the validation.
     *
     * @param  UserRepositoryInterface $users
     * @param                          $value
     * @return bool
     */
    public function handle(UserRepositoryInterface $users, $value)
    {
        if (!$users->findByEmail($value)) {
            return false;
        }

        return true;
    }
}
