<?php namespace Anomaly\DefaultAuthenticatorExtension\Command;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;

class AuthenticateCredentials
{

    /**
     * The credentials to authenticate.
     *
     * @var array
     */
    protected $credentials;

    /**
     * Create a new AuthenticateCredentials instance.
     *
     * @param array $credentials
     */
    public function __construct(array $credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * Handle the command.
     *
     * @param  UserRepositoryInterface                               $users
     * @return \Anomaly\UsersModule\User\Contract\UserInterface|null
     */
    public function handle(UserRepositoryInterface $users)
    {
        if (!isset($this->credentials['password']) && !isset($this->credentials['email'])) {
            return null;
        }

        return $users->findByCredentials($this->credentials);
    }
}
