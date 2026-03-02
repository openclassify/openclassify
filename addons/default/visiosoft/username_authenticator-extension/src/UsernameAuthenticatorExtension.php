<?php namespace Visiosoft\UsernameAuthenticatorExtension;

use Visiosoft\UsernameAuthenticatorExtension\Command\AuthenticateCredentials;
use Anomaly\UsersModule\User\Authenticator\AuthenticatorExtension;

class UsernameAuthenticatorExtension extends AuthenticatorExtension
{

    protected $provides = 'anomaly.module.users::authenticator.username';

    public function authenticate(array $credentials)
    {
        return $this->dispatch(new AuthenticateCredentials($credentials));
    }
}
