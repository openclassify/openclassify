<?php

namespace Anomaly\UsersModule\User;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;

/**
 * Class UserSeeder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UserSeeder extends Seeder
{

    /**
     * The user repository.
     *
     * @var UserRepositoryInterface
     */
    protected $users;

    /**
     * The role repository.
     *
     * @var RoleRepositoryInterface
     */
    protected $roles;

    /**
     * The activator utility.
     *
     * @var UserActivator
     */
    protected $activator;

    /**
     * Create a new UserSeeder instance.
     *
     * @param UserRepositoryInterface $users
     * @param RoleRepositoryInterface $roles
     * @param UserActivator $activator
     */
    public function __construct(
        UserRepositoryInterface $users,
        RoleRepositoryInterface $roles,
        UserActivator $activator
    ) {
        parent::__construct();

        $this->users     = $users;
        $this->roles     = $roles;
        $this->activator = $activator;
    }

    /**
     * Run the seeder.
     */
    public function run()
    {
        if (!env('ADMIN_EMAIL') || !env('ADMIN_USERNAME') || !env('ADMIN_PASSWORD')) {
            throw new \Exception(
                'You must define ADMIN_EMAIL, ADMIN_USERNAME, and ADMIN_PASSWORD in .env to seed the Users module.'
            );
        }

        $this->users->truncate();

        $admin = $this->roles->findBySlug('admin');
        $user  = $this->roles->findBySlug('user');

        $this->users->unguard();

        /* @var UserInterface|UsersUsersEntryModel $administrator */
        $administrator = $this->users->create(
            [
                'display_name' => 'Administrator',
                'email'        => env('ADMIN_EMAIL'),
                'username'     => env('ADMIN_USERNAME'),
                'password'     => env('ADMIN_PASSWORD'),
            ]
        );

        /* @var UserInterface|UsersUsersEntryModel $demo */
        $demo = $this->users->create(
            [
                'display_name' => 'Demo User',
                'email'        => 'demo@pyrocms.com',
                'password'     => 'password',
                'username'     => 'demo',
            ]
        );

        $demo->roles()->sync([$user->getId()]);
        $administrator->roles()->sync([$admin->getId()]);

        $this->activator->force($demo);
        $this->activator->force($administrator);
    }
}
