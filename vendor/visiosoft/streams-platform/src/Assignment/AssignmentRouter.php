<?php namespace Anomaly\Streams\Platform\Assignment;

use Anomaly\Streams\Platform\Addon\Addon;
use Illuminate\Routing\Router;

/**
 * Class AssignmentRouter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentRouter
{

    /**
     * The router instance.
     *
     * @var Router
     */
    protected $router;

    /**
     * Create a new AssignmentRouter instance.
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
    public function route(Addon $addon, $controller, $prefix = null, $base = '/assignments')
    {
        $prefix = $prefix ?: 'admin/' . $addon->getSlug();

        $routes = [
            $prefix . $base . '/{stream}'               => [
                'as'             => $addon->getNamespace('assignments.index'),
                'uses'           => $controller . '@index',
                'streams::addon' => $addon->getNamespace(),
            ],
            $prefix . $base . '/{stream}/choose'        => [
                'as'             => $addon->getNamespace('assignments.choose'),
                'uses'           => $controller . '@choose',
                'streams::addon' => $addon->getNamespace(),
            ],
            $prefix . $base . '/{stream}/create'        => [
                'as'             => $addon->getNamespace('assignments.create'),
                'uses'           => $controller . '@create',
                'streams::addon' => $addon->getNamespace(),
            ],
            $prefix . '/assignments/{stream}/edit/{id}' => [
                'as'             => $addon->getNamespace('assignments.edit'),
                'uses'           => $controller . '@edit',
                'streams::addon' => $addon->getNamespace(),
            ],
        ];

        foreach ($routes as $uri => $route) {
            $this->router->any($uri, $route);
        }
    }
}
