<?php namespace Visiosoft\ProfileModule\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class authCheck
{
    private $auth;
    private $request;

    public function __construct(Guard $auth,Request $request)
    {
        $this->auth = $auth;
        $this->request = $request;
    }

    public function handle(Request $request, Closure $next)
    {
        if ($this->auth->check()) {
            return redirect($this->request->get('redirect', '/'));
        }

        return $next($request);
    }
}
