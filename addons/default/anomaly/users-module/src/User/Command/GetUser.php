<?php namespace Anomaly\UsersModule\User\Command;

use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserPresenter;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class GetUser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetUser
{

    /**
     * The user identifier.
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create a new GetUser instance.
     *
     * @param $identifier
     */
    public function __construct($identifier)
    {
        $this->identifier = $identifier;
    }

    /**
     * Handle the command.
     *
     * @param  UserRepositoryInterface $users
     * @param  Guard $auth
     * @return \Anomaly\UsersModule\User\Contract\UserInterface|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function handle(UserRepositoryInterface $users, Guard $auth)
    {
        if (is_null($this->identifier)) {
            return $auth->user();
        }

        if ($this->identifier instanceof UserInterface) {
            return $this->identifier;
        }

        if ($this->identifier instanceof UserPresenter) {
            return $this->identifier->getObject();
        }

        if (is_numeric($this->identifier)) {
            return $users->find($this->identifier);
        }

        if (is_string($this->identifier)) {
            return $users->findByStrId($this->identifier);
        }

        if (filter_var($this->identifier, FILTER_VALIDATE_EMAIL)) {
            return $users->findByEmail($this->identifier);
        }

        if (!is_numeric($this->identifier)) {
            return $users->findByUsername($this->identifier);
        }

        return null;
    }
}
