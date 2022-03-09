<?php namespace Anomaly\Streams\Platform\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class PoweredBy
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PoweredBy
{

    /**
     * Say it loud.
     *
     * @param  Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /* @var \Illuminate\Http\Response $response */
        $response = $next($request);

        $response->headers->set(
            'X-Streams-Distribution',
            config('streams::distribution.name') . '-' . config('streams::distribution.version')
        );

        return $response;
    }
}
