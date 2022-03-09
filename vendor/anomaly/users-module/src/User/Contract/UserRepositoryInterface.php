<?php namespace Anomaly\UsersModule\User\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface UserRepositoryInterface
 *
 * @method null|UserInterface find($id)
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface UserRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a user by string ID.
     *
     * @param $id
     * @return UserInterface|null
     */
    public function findByStrId($id);

    /**
     * Find a user by their email.
     *
     * @param $email
     * @return null|UserInterface
     */
    public function findByEmail($email);

    /**
     * Find a user by their username.
     *
     * @param $username
     * @return null|UserInterface
     */
    public function findByUsername($username);

    /**
     * Find a user by their credentials.
     *
     * @param  array $credentials
     * @return null|UserInterface
     */
    public function findByCredentials(array $credentials);

    /**
     * Find a user by their reset code.
     *
     * @param $code
     * @return null|UserInterface
     */
    public function findByResetCode($code);

    /**
     * Find a user by their activation code.
     *
     * @param $code
     * @return null|UserInterface
     */
    public function findByActivationCode($code);

    /**
     * Touch a user's last activity and IP.
     *
     * @return bool
     */
    public function touchLastActivity(UserInterface $user);

    /**
     * Touch a user's last login.
     *
     * @return bool
     */
    public function touchLastLogin(UserInterface $user);

    /**
     * Cleanup pending users.
     */
    public function cleanup();
}
