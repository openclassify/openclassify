<?php namespace Anomaly\Streams\Platform\Http\Middleware;

use Anomaly\Streams\Platform\Application\Event\ApplicationHasLoaded;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApplicationReady
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ApplicationReady
{

    /**
     * Fire an event here as we enter the middleware
     * layer of the application so we can hook into it.
     *
     * @param  Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = event(new ApplicationHasLoaded(), [], true);

        if ($response instanceof Response) {
            return $response;
        }

        return $next($request);
    }
}
