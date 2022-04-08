<?php namespace Anomaly\Streams\Platform\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class BypassMaintenanceCheck
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BypassMaintenanceCheck
{

    /**
     * Handle the request.
     *
     * Bypass the Laravel check
     * in it's default position - we will be
     * checking it later JUST after so we can
     * use our bundled view.
     *
     * @param  Request                                 $request
     * @param  callable                                $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
