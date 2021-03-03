<?php namespace Visiosoft\ProfileModule\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

class authCheck
{
    use DispatchesJobs;

    private $auth;
    private $request;
    private $template;

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
