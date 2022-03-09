<?php namespace Anomaly\Streams\Platform\Version;

use Anomaly\Streams\Platform\Addon\Addon;
use Illuminate\Routing\Router;

/**
 * Class VersionRouter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class VersionRouter
{

    /**
     * The router instance.
     *
     * @var Router
     */
    protected $router;

    /**
     * Create a new VersionRouter instance.
     *
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Register field routes.
     *
     * @param Addon  $addon
     * @param        $controller
     * @param null   $prefix
     * @param string $base
     * @internal param $stream
     */
    public function route(Addon $addon, $controller, $prefix = null, $base = '/versions')
    {
        $prefix = $prefix ?: 'admin/' . $addon->getSlug();

        $routes = [
            $prefix . $base . '/{id}' => [
                'as'             => $addon->getNamespace('versions.index'),
                'uses'           => $controller . '@index',
                'streams::addon' => $addon->getNamespace(),
            ],
        ];

        foreach ($routes as $uri => $route) {
            $this->router->any($uri, $route);
        }
    }
}
