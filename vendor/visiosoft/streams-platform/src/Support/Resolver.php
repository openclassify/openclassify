<?php

namespace Anomaly\Streams\Platform\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Contracts\Container\Container;

/**
 * Class Resolver
 *
 * This is a handy class for getting input from
 * a callable target.
 *
 * $someArrayConfig = 'MyCallableClass@handle'
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Resolver
{

    /**
     * The IoC container.
     *
     * @var \Illuminate\Contracts\Container\Container
     */
    protected $container;

    /**
     * Create a new Resolver instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Resolve the target.
     *
     * @param        $target
     * @param  array $arguments
     * @param  array $options
     * @return mixed
     */
    public function resolve($target, array $arguments = [], array $options = [])
    {
        $method = Arr::get($options, 'method', 'handle');

        if ((is_string($target) && Str::contains($target, '@')) || is_callable($target)) {
            $target = $this->container->call($target, $arguments);
        } elseif (is_string($target) && class_exists($target) && method_exists($target, $method)) {
            $target = $this->container->call($target . '@' . $method, $arguments);
        }

        return $target;
    }
}
