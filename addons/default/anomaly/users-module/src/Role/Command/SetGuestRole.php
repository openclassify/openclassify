<?php namespace Anomaly\UsersModule\Role\Command;

use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;


/**
 * Class SetGuestRole
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetGuestRole
{

    /**
     * Handle the command.
     *
     * @param RoleRepositoryInterface $roles
     * @param Authorizer              $authorizer
     */
    public function handle(RoleRepositoryInterface $roles, Authorizer $authorizer)
    {
        $guest = $roles->cache(
            'anomaly.module.users::roles.guest',
            60 * 60 * 24, // 1 day
            function () use ($roles) {
                return $roles->findBySlug('guest');
            }
        );

        if ($guest) {
            $authorizer->setGuest($guest);
        }
    }
}
