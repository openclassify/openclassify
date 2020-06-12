<?php

namespace Visiosoft\ProfileModule\Http\Middleware;

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

    /**
     * @param Guard $auth
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handle()
    {
        if ($this->auth->check()) {
            return redirect($this->request->get('redirect', '/'));
        }
    }
}