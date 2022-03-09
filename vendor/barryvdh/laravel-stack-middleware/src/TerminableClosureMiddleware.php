<?php namespace Barryvdh\StackMiddleware;

class TerminableClosureMiddleware extends ClosureMiddleware
{
    /**
     * Perform any final actions for the request lifecycle.
     *
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     * @return void
     */
    public function terminate($request, $response)
    {
        $this->middleware->terminate($request, $response);
    }
}
