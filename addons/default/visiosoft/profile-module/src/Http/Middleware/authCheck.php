<?php namespace Visiosoft\ProfileModule\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authCheck
{

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            return redirect($request->get('redirect', '/'));
        }
        return $next($request);
    }
}