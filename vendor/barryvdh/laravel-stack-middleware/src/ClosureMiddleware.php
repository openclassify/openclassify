<?php namespace Barryvdh\StackMiddleware;

use Closure;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class ClosureMiddleware
{
    /** @var ClosureHttpKernel $kernel */
    protected $kernel;

    /** @var HttpKernelInterface $middleware */
    protected $middleware;

    /**
     * @param  ClosureHttpKernel   $kernel
     * @param  HttpKernelInterface $middleware
     */
    public function __construct(ClosureHttpKernel $kernel, HttpKernelInterface $middleware)
    {
        $this->kernel = $kernel;
        $this->middleware = $middleware;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure                  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->kernel->setClosure($next);

        return $this->middleware->handle($request);
    }
}
