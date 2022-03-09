<?php namespace Anomaly\Streams\Platform\Field;

use Anomaly\Streams\Platform\Addon\Addon;
use Illuminate\Routing\Router;

/**
 * Class FieldRouter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FieldRouter
{

    /**
     * The router instance.
     *
     * @var Router
     */
    protected $router;

    /**
     * Create a new FieldRouter instance.
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
     */
    public function route(Addon $addon, $controller, $prefix = null, $base = '/fields')
    {
        $prefix = $prefix ?: 'admin/' . $addon->getSlug();

        $routes = [
            $prefix . $base                 => [
                'as'             => $addon->getNamespace('fields.index'),
                'uses'           => $controller . '@index',
                'streams::addon' => $addon->getNamespace(),
            ],
            $prefix . $base . '/choose'     => [
                'as'             => $addon->getNamespace('fields.choose'),
                'uses'           => $controller . '@choose',
                'streams::addon' => $addon->getNamespace(),
            ],
            $prefix . $base . '/create'     => [
                'as'             => $addon->getNamespace('fields.create'),
                'uses'           => $controller . '@create',
                'streams::addon' => $addon->getNamespace(),
            ],
            $prefix . '/fields/edit/{id}'   => [
                'as'             => $addon->getNamespace('fields.edit'),
                'uses'           => $controller . '@edit',
                'streams::addon' => $addon->getNamespace(),
            ],
            $prefix . '/fields/change/{id}' => [
                'as'             => $addon->getNamespace('fields.change'),
                'uses'           => $controller . '@change',
                'streams::addon' => $addon->getNamespace(),
            ],
        ];

        foreach ($routes as $uri => $route) {
            $this->router->any($uri, $route);
        }
    }
}
