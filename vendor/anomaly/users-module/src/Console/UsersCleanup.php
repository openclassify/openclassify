<?php namespace Anomaly\UsersModule\Console;

use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Console\Command;

/**
 * Class UsersCleanup
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UsersCleanup extends Command
{

    /**
     * Cleanup pending users.
     *
     * @var string
     */
    protected $name = 'users:cleanup';

    public function handle(UserRepositoryInterface $users)
    {
        $users->cleanup();
    }
}
