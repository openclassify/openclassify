<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\UsersModule\Role\RoleCollection;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Routing\ResponseFactory;

/**
 * Class PageAuthorizer
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PageAuthorizer
{

    /**
     * The authorization utility.
     *
     * @var Guard
     */
    protected $guard;

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The response factory.
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new PageAuthorizer instance.
     *
     * @param Guard           $guard
     * @param Repository      $config
     * @param Authorizer      $authorizer
     * @param ResponseFactory $response
     */
    public function __construct(Guard $guard, Repository $config, Authorizer $authorizer, ResponseFactory $response)
    {
        $this->guard      = $guard;
        $this->config     = $config;
        $this->response   = $response;
        $this->authorizer = $authorizer;
    }

    /**
     * Authorize the page.
     *
     * @param PageInterface $page
     */
    public function authorize(PageInterface $page)
    {
        /* @var UserInterface $user */
        $user = $this->guard->user();

        /* @var RoleCollection $allowed */
        $allowed = $page->getAllowedRoles();

        /*
         * If the page is not enabled yet check and make
         * sure that we are allowed to preview it first.
         */
        if (!$page->isLive() && !$this->authorizer->authorize('anomaly.module.pages::pages.preview')) {
            abort(403);
        }

        /*
         * Check the roles against the
         * user if there are any.
         */
        if (
            $page->isLive()
            && !$allowed->isEmpty()
            && (!$user || (!$user->hasAnyRole($allowed) && !$user->isAdmin()))
        ) {
            $page->setResponse($this->response->redirectGuest('login'));
        }
    }
}
