<?php

namespace Anomaly\Streams\Platform\Entry;

use Illuminate\Support\Str;
use Anomaly\Streams\Platform\Support\Locator;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Class EntryRouter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryRouter
{

    use DispatchesJobs;

    /**
     * The URL generator;
     *
     * @var UrlGenerator
     */
    protected $url;

    /**
     * The entry instance.
     *
     * @var EntryInterface
     */
    protected $entry;

    /**
     * The locator utility.
     *
     * @var Locator
     */
    protected $locator;

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new EntryRouter instance.
     *
     * @param UrlGenerator $url
     * @param EntryInterface $entry
     * @param Locator $locator
     * @param Container $container
     */
    public function __construct(
        UrlGenerator $url,
        EntryInterface $entry,
        Locator $locator,
        Container $container
    ) {
        $this->url       = $url;
        $this->entry     = $entry;
        $this->locator   = $locator;
        $this->container = $container;
    }

    /**
     * Make a route.
     *
     * @param                    $route
     * @param  array $parameters
     * @return mixed|null|string
     */
    public function make($route, array $parameters = [])
    {
        if (method_exists($this, $method = camel_case(str_replace('.', '_', $route)))) {

            $parameters['parameters'] = $parameters;

            return $this->container->call([$this, $method], $parameters);
        }

        if (!Str::contains($route, '.') && $stream = $this->entry->getStreamSlug()) {
            $route = "{$stream}.{$route}";
        }

        if (!Str::contains($route, '::') && $namespace = $this->locator->locate($this->entry)) {
            $route = "{$namespace}::{$route}";
        }

        return $this->url->make($route, $this->entry, $parameters);
    }

    //    /**
    //     * Return the create route.
    //     *
    //     * @return string|null
    //     */
    //    public function create()
    //    {
    //        $namespace = explode('.', $this->locator->locate($this->entry));
    //
    //        if (!$addon = $this->locator->locate($this->entry)) {
    //            return null;
    //        }
    //
    //        $segments = [
    //            'admin',
    //            array_pop($namespace),
    //            $this->entry->getStreamSlug(),
    //            'create',
    //        ];
    //
    //        return implode('/', array_unique($segments));
    //    }
    //
    //    /**
    //     * Return the edit route.
    //     *
    //     * @return string|null
    //     */
    //    public function edit()
    //    {
    //        $namespace = explode('.', $this->locator->locate($this->entry));
    //
    //        if (!$addon = $this->locator->locate($this->entry)) {
    //            return null;
    //        }
    //
    //        $segments = [
    //            'admin',
    //            array_pop($namespace),
    //            $this->entry->getStreamSlug(),
    //            'edit',
    //            $this->entry->getId(),
    //        ];
    //
    //        return implode('/', array_unique($segments));
    //    }
}
