<?php namespace Anomaly\PagesModule\Page\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\PageCollection;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class RemoveRestrictedPages
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RemoveRestrictedPages
{

    /**
     * The page collection.
     *
     * @var PageCollection
     */
    protected $pages;

    /**
     * Create a new RemoveRestrictedPages instance.
     *
     * @param PageCollection $pages
     */
    public function __construct(PageCollection $pages)
    {
        $this->pages = $pages;
    }

    /**
     * Handle the command.
     *
     * @param  Guard $auth
     * @return PageCollection
     */
    public function handle(Guard $auth)
    {
        /* @var UserInterface|null $user */
        $user = $auth->user();

        /* @var PageInterface $page */
        foreach ($this->pages as $key => $page) {

            $roles = $page->getAllowedRoles();

            /*
             * Admin's can see
             * absolutely everything.
             */
            if ($user && $user->isAdmin()) {
                continue;
            }

            /*
             * If there is a guest role and
             * no user then this page
             * can display. Otherwise
             * we need to hide it.
             */
            if ($roles->has('guest') && !$user) {
                continue;
            }

            /*
             * If there is a guest role and
             * there IS a user then this page
             * can NOT display. Forget it.
             */
            if ($roles->has('guest') && $user) {

                $this->pages->forget($key);

                continue;
            }

            /*
             * If there are role restrictions
             * but no user is signed in then
             * we can't authorize anything!
             */
            if (!$roles->isEmpty() && !$user) {

                $this->pages->forget($key);

                continue;
            }

            /*
             * If there are role restrictions
             * and the user does not belong to
             * any of them then don't show it.
             */
            if (!$roles->isEmpty() && !$user->hasAnyRole($roles)) {

                $this->pages->forget($key);

                continue;
            }
        }

        return $this->pages;
    }
}
