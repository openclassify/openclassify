<?php

namespace Anomaly\RedirectsModule\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class RedirectDomains
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RedirectDomains
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!file_exists($domains = app_storage_path('redirects/domains.php'))) {
            return $next($request);
        }

        if (!$domains = require $domains) {
            return $next($request);
        }

        if ($redirect = array_get($domains, $request->getHttpHost())) {
            return redirect(
                ($request->isSecure() ? 'https' : 'http') . '://' . array_get(
                    $redirect,
                    'to',
                    config('streams::system.domain')
                ) . '/' . trim($request->path(), '/'),
                $redirect['status'],
                [],
                config('streams::system.force_ssl', false) ?: $redirect['secure']
            );
        }

        return $next($request);
    }
}
