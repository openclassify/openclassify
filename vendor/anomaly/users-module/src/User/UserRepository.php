<?php namespace Anomaly\UsersModule\User;

use Anomaly\Streams\Platform\Entry\EntryRepository;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;

/**
 * Class UserRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UserRepository extends EntryRepository implements UserRepositoryInterface
{

    /**
     * The user model.
     *
     * @var UserModel
     */
    protected $model;

    /**
     * Create a new UserRepository instance.
     *
     * @param UserModel $model
     */
    function __construct(UserModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a user by string ID.
     *
     * @param $id
     * @return UserInterface|null
     */
    public function findByStrId($id)
    {
        return $this->model->where('str_id', $id)->first();
    }

    /**
     * Find a user by their credentials.
     *
     * @param  array $credentials
     * @return null|UserInterface
     */
    public function findByCredentials(array $credentials)
    {
        if (isset($credentials['email'])) {
            $user = $this->findByEmail($credentials['email']);
        } elseif (isset($credentials['username'])) {
            $user = $this->findByUsername($credentials['username']);
        } else {
            return null;
        }

        if ($user && app('hash')->check($credentials['password'], $user->password)) {
            return $user;
        }

        return null;
    }

    /**
     * Find a user by their email.
     *
     * @param $email
     * @return null|UserInterface
     */
    public function findByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Find a user by their username.
     *
     * @param $username
     * @return null|UserInterface
     */
    public function findByUsername($username)
    {
        return $this->model->where('username', $username)->first();
    }

    /**
     * Find a user by their reset code.
     *
     * @param $code
     * @return null|UserInterface
     */
    public function findByResetCode($code)
    {
        return $this->model->where('reset_code', $code)->first();
    }

    /**
     * Find a user by their activation code.
     *
     * @param $code
     * @return null|UserInterface
     */
    public function findByActivationCode($code)
    {
        return $this->model->where('activation_code', $code)->first();
    }

    /**
     * Touch a user's last activity and IP.
     *
     * @param  UserInterface|EloquentModel $user
     * @return bool
     */
    public function touchLastActivity(UserInterface $user)
    {
        $user->last_activity_at = time();
        $user->ip_address       = request()->ip();

        return $this->withoutEvents(
            function () use ($user) {
                return $user->save();
            }
        );
    }

    /**
     * Touch a user's last login.
     *
     * @param  UserInterface $user
     * @return bool
     */
    public function touchLastLogin(UserInterface $user)
    {
        $user->last_login_at = time();

        return $this->save($user);
    }

    /**
     * Cleanup pending users.
     */
    public function cleanup()
    {
        $stale = $this->model
            ->where('activated', false)
            ->whereDate('created_at', '<', now()->subMonth())
            ->get();

        foreach ($stale as $user) {
            $this->forceDelete($user);
        }
    }
}
