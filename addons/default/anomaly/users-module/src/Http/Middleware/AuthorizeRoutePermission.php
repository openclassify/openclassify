<?php namespace Anomaly\UsersModule\Http\Middleware;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Session\Store;

/**
 * Class AuthorizeRoutePermission
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AuthorizeRoutePermission
{

    /**
     * The auth guard.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The route object.
     *
     * @var Route
     */
    protected $route;

    /**
     * The session store.
     *
     * @var Store
     */
    protected $session;

    /**
     * The redirect utility.
     *
     * @var Redirector
     */
    protected $redirect;

    /**
     * The message bag.
     *
     * @var MessageBag
     */
    protected $messages;

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new AuthorizeModuleAccess instance.
     *
     * @param Guard $auth
     * @param Route $route
     * @param Store $session
     * @param Redirector $redirect
     * @param MessageBag $messages
     * @param Authorizer $authorizer
     */
    public function __construct(
        Guard $auth,
        Route $route,
        Store $session,
        Redirector $redirect,
        MessageBag $messages,
        Authorizer $authorizer
    ) {
        $this->auth       = $auth;
        $this->route      = $route;
        $this->session    = $session;
        $this->redirect   = $redirect;
        $this->messages   = $messages;
        $this->authorizer = $authorizer;
    }

    /**
     * Check the authorization of module access.
     *
     * @param  Request $request
     * @param  \Closure $next
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (in_array($request->path(), ['admin/login', 'admin/logout'])) {
            return $next($request);
        }

        if ($request->segment(1) == 'admin' && !$this->authorizer->authorize(
                'streams::general.control_panel'
            )
        ) {
            abort(403);
        }

        /**
         * Check if the user is an admin.
         *
         * @var UserInterface $user
         */
        if (($user = $this->auth->user()) && $user->isAdmin()) {
            return $next($request);
        }
        
        $permission = (array)array_get($this->route->getAction(), 'anomaly.module.users::permission');

        if ($permission && !$this->authorizer->authorizeAny($permission, null, true)) {

            $redirect = array_get($this->route->getAction(), 'anomaly.module.users::redirect');
            $intended = array_get($this->route->getAction(), 'anomaly.module.users::intended');
            $message  = array_get($this->route->getAction(), 'anomaly.module.users::message');

            if ($message) {
                $this->messages->error($message);
            }

            if ($intended !== false) {
                $this->session->put('url.intended', $request->fullUrl());
            }

            if ($redirect) {
                return $this->redirect->to($redirect);
            }

            $route = array_get($this->route->getAction(), 'anomaly.module.users::route');

            if ($route) {
                return $this->redirect->route($route);
            }

            abort(403);
        }

        return $next($request);
    }
}
