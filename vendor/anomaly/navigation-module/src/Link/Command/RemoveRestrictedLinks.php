<?php namespace Anomaly\NavigationModule\Link\Command;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\UsersModule\Role\RoleCollection;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class RemoveRestrictedLinks
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class RemoveRestrictedLinks
{

    /**
     * The link collection.
     *
     * @var LinkCollection
     */
    protected $links;

    /**
     * Create a new RemoveRestrictedLinks instance.
     *
     * @param LinkCollection $links
     */
    public function __construct(LinkCollection $links)
    {
        $this->links = $links;
    }

    /**
     * Handle the command.
     *
     * @param Guard $auth
     */
    public function handle(Guard $auth)
    {
        /* @var UserInterface|null $user */
        $user = $auth->user();

        /* @var LinkInterface $link */
        foreach ($this->links as $key => $link) {

            /* @var RoleCollection $roles */
            $roles = $link->getAllowedRoles();

            /**
             * Nothing to do!
             */
            if ($roles->isEmpty()) {
                continue;
            }

            // Pull out the guest role.
            $guest = $roles->findBy('slug', 'guest');

            /*
             * If there is a guest role and
             * no user then this link
             * can display. Otherwise
             * we need to hide it.
             */
            if ($guest && !$user) {
                continue;
            }

            /*
             * If there is a guest role and
             * there IS a user then this link
             * can NOT display. Forget it.
             */
            if ($guest && $user) {

                $this->links->forget($key);

                continue;
            }

            /*
             * If there are role restrictions
             * but no user is signed in then
             * we can't authorize anything!
             */
            if (!$roles->isEmpty() && !$user) {

                $this->links->forget($key);

                continue;
            }

            /*
             * If there are role restrictions
             * and the user does not belong to
             * any of them then don't show it.
             */
            if (!$roles->isEmpty() && !$user->hasAnyRole($roles) && !$user->isAdmin()) {

                $this->links->forget($key);

                continue;
            }
        }
    }
}
