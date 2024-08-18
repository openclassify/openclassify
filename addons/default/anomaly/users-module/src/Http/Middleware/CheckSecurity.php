<?php namespace Anomaly\UsersModule\Http\Middleware;

use Anomaly\UsersModule\User\UserSecurity;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CheckSecurityRequest
 *
 * This class replaces the Laravel version in app/
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CheckSecurity
{

    /**
     * The security utility.
     *
     * @var UserSecurity
     */
    protected $security;

    /**
     * Create a new CheckSecurity instance.
     *
     * @param UserSecurity $security
     */
    public function __construct(UserSecurity $security)
    {
        $this->security = $security;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return bool|\Illuminate\Http\RedirectResponse|mixed|string
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->segment(1) !== 'admin' || in_array($request->path(), ['admin/login', 'admin/logout'])) {
            return $next($request);
        }

        $response = $this->security->check(auth()->user());

        if ($response instanceof Response) {
            return $response;
        }

        return $next($request);
    }
}
