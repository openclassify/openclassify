<?php namespace Anomaly\UsersModule\User\Command;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;

/**
 * Class GetUserFromCredentials
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetUserFromCredentials
{

    /**
     * The user credentials.
     *
     * @var array
     */
    protected $credentials;

    /**
     * Create a new GetUserFromCredentials instance.
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
     * @param UserRepositoryInterface $users
     * @return UserInterface|null
     */
    public function handle(UserRepositoryInterface $users)
    {
        if (!isset($this->credentials['password']) && !isset($this->credentials['email'])) {
            return null;
        }

        return $users->findByCredentials($this->credentials);
    }
}
