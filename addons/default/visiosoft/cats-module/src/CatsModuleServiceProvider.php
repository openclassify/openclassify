<?php namespace Visiosoft\CatsModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Visiosoft\CatsModule\Placeholderforsearch\Contract\PlaceholderforsearchRepositoryInterface;
use Visiosoft\CatsModule\Placeholderforsearch\PlaceholderforsearchRepository;
use Anomaly\Streams\Platform\Model\Cats\CatsPlaceholderforsearchEntryModel;
use Visiosoft\CatsModule\Placeholderforsearch\PlaceholderforsearchModel;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\CategoryRepository;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;
use Visiosoft\CatsModule\Category\CategoryModel;
use Illuminate\Routing\Router;

class CatsModuleServiceProvider extends AddonServiceProvider
{

    /**
     * Additional addon plugins.
     *
     * @type array|null
     */
    protected $plugins = [
        CatsModulePlugin::class,
    ];

    /**
     * The addon Artisan commands.
     *
     * @type array|null
     */
    protected $commands = [];

    /**
     * The addon's scheduled commands.
     *
     * @type array|null
     */
    protected $schedules = [];

    /**
     * The addon API routes.
     *
     * @type array|null
     */
    protected $api = [];

    /**
     * The addon routes.
     *
     * @type array|null
     */
    protected $routes = [
        'admin/cats/placeholderforsearch' => 'Visiosoft\CatsModule\Http\Controller\Admin\PlaceholderforsearchController@index',
        'admin/cats/placeholderforsearch/create' => 'Visiosoft\CatsModule\Http\Controller\Admin\PlaceholderforsearchController@create',
        'admin/cats/placeholderforsearch/edit/{id}' => 'Visiosoft\CatsModule\Http\Controller\Admin\PlaceholderforsearchController@edit',
        'admin/cats' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@index',
        'admin/cats/create' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@create',
        'admin/cats/edit/{id}' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@edit',
        'admin/cats/category/delete/{id}' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@delete',
    ];

    /**
     * The addon middleware.
     *
     * @type array|null
     */
    protected $middleware = [
        //Visiosoft\CatsModule\Http\Middleware\ExampleMiddleware::class
    ];

    /**
     * Addon group middleware.
     *
     * @var array
     */
    protected $groupMiddleware = [
        //'web' => [
        //    Visiosoft\CatsModule\Http\Middleware\ExampleMiddleware::class,
        //],
    ];

    /**
     * Addon route middleware.
     *
     * @type array|null
     */
    protected $routeMiddleware = [];

    /**
     * The addon event listeners.
     *
     * @type array|null
     */
    protected $listeners = [
        //Visiosoft\CatsModule\Event\ExampleEvent::class => [
        //    Visiosoft\CatsModule\Listener\ExampleListener::class,
        //],
    ];

    /**
     * The addon alias bindings.
     *
     * @type array|null
     */
    protected $aliases = [
        //'Example' => Visiosoft\CatsModule\Example::class
    ];

    /**
     * The addon class bindings.
     *
     * @type array|null
     */
    protected $bindings = [
        CatsPlaceholderforsearchEntryModel::class => PlaceholderforsearchModel::class,
        CatsCategoryEntryModel::class => CategoryModel::class,
    ];

    /**
     * The addon singleton bindings.
     *
     * @type array|null
     */
    protected $singletons = [
        PlaceholderforsearchRepositoryInterface::class => PlaceholderforsearchRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
    ];

    /**
     * Additional service providers.
     *
     * @type array|null
     */
    protected $providers = [
        //\ExamplePackage\Provider\ExampleProvider::class
    ];

    /**
     * The addon view overrides.
     *
     * @type array|null
     */
    protected $overrides = [
        //'streams::errors/404' => 'module::errors/404',
        //'streams::errors/500' => 'module::errors/500',
    ];

    /**
     * The addon mobile-only view overrides.
     *
     * @type array|null
     */
    protected $mobile = [
        //'streams::errors/404' => 'module::mobile/errors/404',
        //'streams::errors/500' => 'module::mobile/errors/500',
    ];

    /**
     * Register the addon.
     */
    public function register()
    {
        // Run extra pre-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Boot the addon.
     */
    public function boot()
    {
        // Run extra post-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Map additional addon routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        // Register dynamic routes here for example.
        // Use method injection or commands to bring in services.
    }

}
