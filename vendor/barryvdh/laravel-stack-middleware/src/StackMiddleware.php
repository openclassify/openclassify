<?php namespace Barryvdh\StackMiddleware;

use Illuminate\Contracts\Container\Container;
use Symfony\Component\HttpKernel\TerminableInterface;

class StackMiddleware
{
    /** @var Container $container */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Wrap and register the middleware in the Container.
     *
     * @param  string          $abstract
     * @param  callable|string $callable
     * @param  array           $params
     */
    public function bind($abstract, $callable, $params = [])
    {
        $this->container->bind($abstract, function () use ($callable, $params) {
            return $this->wrap($callable, $params);
        });
    }

    /**
     * Wrap the StackPHP Middleware in a Laravel Middleware.
     *
     * @param  callable|string $callable
     * @param  array           $params
     *
     * @return ClosureMiddleware
     */
    public function wrap($callable, $params = [])
    {
        $kernel = new ClosureHttpKernel();

        if (is_callable($callable)) {
            $middleware = $callable($kernel);
        } else {
            // Add kernel as 'app' parameter
            $params = ['app' => $kernel] + $params;
            $makeMethod = method_exists($this->container, 'makeWith') ?  'makeWith' : 'make';
            $middleware = $this->container->$makeMethod($callable, $params);
        }

        if ($middleware instanceof TerminableInterface) {
            return new TerminableClosureMiddleware($kernel, $middleware);
        }

        return new ClosureMiddleware($kernel, $middleware);
    }
}
