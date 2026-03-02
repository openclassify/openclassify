<?php namespace Visiosoft\UsernameAuthenticatorExtension\Command;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;

class AuthenticateCredentials
{

    protected $credentials;

    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    public function handle(UserRepositoryInterface $users)
    {
        if (!isset($this->credentials['password']) && !isset($this->credentials['username'])) {
            return null;
        }

        return $users->findByCredentials($this->credentials);
    }
}
