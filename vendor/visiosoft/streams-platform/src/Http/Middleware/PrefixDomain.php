<?php namespace Anomaly\Streams\Platform\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

/**
 * Class PrefixDomain
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PrefixDomain
{

    /**
     * The redirect utility.
     *
     * @var Redirector
     */
    protected $redirect;

    /**
     * Create a new PoweredBy instance.
     *
     * @param Redirector $redirect
     */
    public function __construct(Redirector $redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * Force SSL connections.
     *
     * @param  Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$prefix = config('streams::system.domain_prefix')) {
            return $next($request);
        }

        if ($prefix == 'www' && !starts_with($request->getHost(), 'www.')) {
            return $this->redirect->to(
                preg_replace(
                    '/' . preg_quote($request->getHost()) . '/',
                    'www.' . $request->getHost(),
                    $request->fullUrl(),
                    1
                ),
                301
            );
        }

        if ($prefix == 'non-www' && starts_with($request->getHost(), 'www.')) {
            return $this->redirect->to(
                preg_replace(
                    '/' . preg_quote($request->getHost()) . '/',
                    str_replace('www.', '', $request->getHost()),
                    $request->fullUrl(),
                    1
                ),
                301
            );
        }

        return $next($request);
    }
}
