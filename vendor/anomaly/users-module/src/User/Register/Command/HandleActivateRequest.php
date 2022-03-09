<?php namespace Anomaly\UsersModule\User\Register\Command;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserActivator;
use Anomaly\UsersModule\User\UserAuthenticator;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Http\Request;

class HandleActivateRequest
{

    /**
     * Handle the command.
     *
     * @param  UserRepositoryInterface $users
     * @param  UserAuthenticator       $authenticator
     * @param  UserActivator           $activator
     * @param  Encrypter               $encrypter
     * @param  Request                 $request
     * @return bool
     */
    public function handle(
        UserRepositoryInterface $users,
        UserAuthenticator $authenticator,
        UserActivator $activator,
        Encrypter $encrypter,
        Request $request
    )
    {
        if (!$code = $request->get('code')) {
            return false;
        }

        if (!$email = $request->get('email')) {
            return false;
        }

        if (!$user = $users->findByEmail($encrypter->decrypt($email))) {
            return false;
        }

        if ($activated = $activator->activate($user, $encrypter->decrypt($code))) {
            $authenticator->login($user);
        }

        return $activated;
    }
}
