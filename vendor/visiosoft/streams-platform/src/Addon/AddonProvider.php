<?php

namespace Anomaly\Streams\Platform\Addon;

use Illuminate\Support\Str;
use Illuminate\Routing\Router;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Console\Events\ArtisanStarting;
use Anomaly\Streams\Platform\Addon\Theme\Theme;
use Anomaly\Streams\Platform\View\ViewOverrides;
use Illuminate\Contracts\Foundation\Application;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Anomaly\Streams\Platform\View\ViewMobileOverrides;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\View\Event\RegisteringTwigPlugins;
use Anomaly\Streams\Platform\Http\Middleware\MiddlewareCollection;

/**
 * Class AddonProvider
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class AddonProvider
{
    use Macroable;
    use FiresCallbacks;

    /**
     * The cached services.
     *
     * @var array
     */
    protected $cached = [];

    /**
     * The registered providers.
     *
     * @var array
     */
    protected $providers = [];

    /**
     * The router instance.
     *
     * @var Router
     */
    protected $router;

    /**
     * The scheduler instance.
     *
     * @var Schedule
     */
    protected $schedule;

    /**
     * The application container.
     *
     * @var Application
     */
    protected $application;

    /**
     * The middleware collection.
     *
     * @var MiddlewareCollection
     */
    protected $middlewares;

    /**
     * The view overrides.
     *
     * @var ViewOverrides
     */
    protected $viewOverrides;

    /**
     * The mobile view overrides.
     *
     * @var ViewMobileOverrides
     */
    protected $viewMobileOverrides;

    /**
     * Create a new AddonProvider instance.
     *
     * @param Router $router
     * @param Schedule $schedule
     * @param Application $application
     * @param ViewOverrides $viewOverrides
     * @param MiddlewareCollection $middlewares
     * @param ViewMobileOverrides $viewMobileOverrides
     */
    public function __construct(
        Router $router,
        Schedule $schedule,
        Application $application,
        ViewOverrides $viewOverrides,
        MiddlewareCollection $middlewares,
        ViewMobileOverrides $viewMobileOverrides
    ) {
        $this->router              = $router;
        $this->schedule            = $schedule;
        $this->application         = $application;
        $this->middlewares         = $middlewares;
        $this->viewOverrides       = $viewOverrides;
        $this->viewMobileOverrides = $viewMobileOverrides;
    }

    /**
     * Register the service provider for an addon.
     *
     * @param Addon $addon
     */
    public function register(Addon $addon)
    {
        if ($addon instanceof Module && !$addon->isEnabled() && $addon->getSlug() !== 'installer') {
            return;
        }

        if ($addon instanceof Extension && !$addon->isEnabled()) {
            return;
        }

        if ($addon instanceof Theme && !$addon->isActive()) {
            return;
        }

        $provider = $addon->getServiceProvider();

        if (!class_exists($provider)) {
            return;
        }

        $this->providers[] = $provider = $addon->newServiceProvider();

        $this->fire('register', ['provider' => $provider, 'addon' => $addon, 'addonProvider' => $this]);

        $this->bindAliases($provider);
        $this->bindClasses($provider);
        $this->bindSingletons($provider);
        $this->registerOverrides($provider);

        $this->registerRoutes($provider, $addon);
        $this->registerApi($provider, $addon);

        $this->registerEvents($provider);
        $this->registerPlugins($provider);
        $this->registerCommands($provider);
        $this->registerSchedules($provider);
        $this->registerMiddleware($provider);
        $this->registerGroupMiddleware($provider);
        $this->registerRouteMiddleware($provider);

        if (method_exists($provider, 'register')) {
            $this->application->call([$provider, 'register'], ['provider' => $this]);
        }

        // Call other providers last.
        $this->registerProviders($provider);

        $this->fire('registered', ['provider' => $provider, 'addon' => $addon, 'addonProvider' => $this]);
    }

    /**
     * Boot the service providers.
     */
    public function boot()
    {
        $booted = array_get($this->cached, 'booted', []);

        foreach ($this->providers as $provider) {

            if (in_array($class = get_class($provider), $booted)) {
                continue;
            }

            $this->cached['booted'][] = $class;

            if (method_exists($provider, 'boot')) {
                $this->application->call([$provider, 'boot']);
            }

            $this->registerAdditionalRoutes($provider);
        }
    }

    /**
     * Register the addon providers.
     *
     * @param AddonServiceProvider $provider
     */
    protected function registerProviders(AddonServiceProvider $provider)
    {
        foreach ($provider->getProviders() as $provider) {
            $this->application->register($provider);
        }
    }

    /**
     * Register the addon commands.
     *
     * @param AddonServiceProvider $provider
     */
    protected function registerCommands(AddonServiceProvider $provider)
    {
        if ($commands = $provider->getCommands()) {

            // To register the commands with Artisan, we will grab each of the arguments
            // passed into the method and listen for Artisan "start" event which will
            // give us the Artisan console instance which we will give commands to.
            app(Dispatcher::class)->listen(
                'Illuminate\Console\Events\ArtisanStarting',
                function (ArtisanStarting $event) use ($commands) {
                    $event->artisan->resolveCommands($commands);
                }
            );
        }
    }

    /**
     * Bind class aliases.
     *
     * @param AddonServiceProvider $provider
     */
    protected function bindAliases(AddonServiceProvider $provider)
    {
        if ($aliases = $provider->getAliases()) {
            AliasLoader::getInstance($aliases)->register();
        }
    }

    /**
     * Bind addon classes.
     *
     * @param AddonServiceProvider $provider
     */
    protected function bindClasses(AddonServiceProvider $provider)
    {
        foreach ($provider->getBindings() as $abstract => $concrete) {
            $this->application->bind($abstract, $concrete);
        }
    }

    /**
     * Bind addon singletons.
     *
     * @param AddonServiceProvider $provider
     */
    protected function bindSingletons(AddonServiceProvider $provider)
    {
        foreach ($provider->getSingletons() as $abstract => $concrete) {
            $this->application->singleton($abstract, $concrete);
        }
    }

    /**
     * Register the addon events.
     *
     * @param AddonServiceProvider $provider
     */
    protected function registerEvents(AddonServiceProvider $provider)
    {
        if (!$listen = $provider->getListeners()) {
            return;
        }

        foreach ($listen as $event => $listeners) {
            foreach ($listeners as $key => $listener) {
                if (is_integer($listener)) {
                    $priority = $listener;
                    $listener = $key;
                } else {
                    $priority = 0;
                }

                app(Dispatcher::class)->listen($event, $listener, $priority);
            }
        }
    }

    /**
     * Register the addon routes.
     *
     * @param AddonServiceProvider $provider
     * @param Addon $addon
     */
    protected function registerRoutes(AddonServiceProvider $provider, Addon $addon)
    {
        if ($this->routesAreCached()) {
            return;
        }

        if (!$routes = $provider->getRoutes()) {
            return;
        }

        foreach ($routes as $uri => $route) {

            /**
             * Check if the route is a view. In
             * which case we can simplify things.
             */
            if (is_string($route) && Str::contains($route, ['.', '::'])) {

                \Route::view($uri, $route);

                continue;
            }

            /*
             * If the route definition is an
             * not an array then let's make it one.
             * Array type routes give us more control
             * and allow us to pass information in the
             * request's route action array.
             */
            if (!is_array($route)) {
                $route = [
                    'uses' => $route,
                ];
            }

            $verb = array_pull($route, 'verb', 'any');

            $group       = array_pull($route, 'group', []);
            $middleware  = array_pull($route, 'middleware', []);
            $constraints = array_pull($route, 'constraints', []);


            if (!isset($route['streams::addon'])) {
                array_set($route, 'streams::addon', $addon->getNamespace());
            }

            if (is_string($route['uses']) && !Str::contains($route['uses'], '@')) {
                $this->router->resource($uri, $route['uses']);
            } else {

                $route = $this->router->{$verb}($uri, $route)->where($constraints);

                if ($middleware) {
                    call_user_func_array([$route, 'middleware'], (array) $middleware);
                }

                if ($group) {
                    call_user_func_array([$route, 'group'], (array) $group);
                }
            }
        }
    }

    /**
     * Register the addon routes.
     *
     * @param AddonServiceProvider $provider
     * @param Addon $addon
     */
    protected function registerApi(AddonServiceProvider $provider, Addon $addon)
    {
        if ($this->routesAreCached()) {
            return;
        }

        if (!$routes = $provider->getApi()) {
            return;
        }

        $this->router->group(
            [
                'middleware' => 'auth:api',
            ],
            function (Router $router) use ($routes, $addon) {

                foreach ($routes as $uri => $route) {

                    /*
                     * If the route definition is an
                     * not an array then let's make it one.
                     * Array type routes give us more control
                     * and allow us to pass information in the
                     * request's route action array.
                     */
                    if (!is_array($route)) {
                        $route = [
                            'uses' => $route,
                        ];
                    }

                    $verb        = array_pull($route, 'verb', 'any');
                    $middleware  = array_pull($route, 'middleware', []);
                    $constraints = array_pull($route, 'constraints', []);


                    if (!isset($route['streams::addon'])) {
                        array_set($route, 'streams::addon', $addon->getNamespace());
                    }

                    if (is_string($route['uses']) && !Str::contains($route['uses'], '@')) {
                        $router->resource($uri, $route['uses']);
                    } else {

                        $route = $router->{$verb}($uri, $route)->where($constraints);

                        if ($middleware) {
                            call_user_func_array([$route, 'middleware'], (array) $middleware);
                        }
                    }
                }
            }
        );
    }

    /**
     * Register field routes.
     *
     * @param Addon $addon
     * @param       $controller
     * @param null $segment
     */
    public function registerFieldsRoutes(Addon $addon, $controller, $segment = null)
    {
        if ($segment) {
            $segment = $addon->getSlug();
        }

        $routes = [
            'admin/' . $segment . '/fields'             => [
                'as'   => $addon->getNamespace('fields.index'),
                'uses' => $controller . '@index',
            ],
            'admin/' . $segment . '/fields/choose'      => [
                'as'   => $addon->getNamespace('fields.choose'),
                'uses' => $controller . '@choose',
            ],
            'admin/' . $segment . '/fields/create'      => [
                'as'   => $addon->getNamespace('fields.create'),
                'uses' => $controller . '@create',
            ],
            'admin/' . $segment . '/fields/edit/{id}'   => [
                'as'   => $addon->getNamespace('fields.edit'),
                'uses' => $controller . '@edit',
            ],
            'admin/' . $segment . '/fields/change/{id}' => [
                'as'   => $addon->getNamespace('fields.change'),
                'uses' => $controller . '@change',
            ],
        ];

        foreach ($routes as $uri => $route) {

            /*
             * If the route definition is an
             * not an array then let's make it one.
             * Array type routes give us more control
             * and allow us to pass information in the
             * request's route action array.
             */
            if (!is_array($route)) {
                $route = [
                    'uses' => $route,
                ];
            }

            $verb        = array_pull($route, 'verb', 'any');
            $middleware  = array_pull($route, 'middleware', []);
            $constraints = array_pull($route, 'constraints', []);

            array_set($route, 'streams::addon', $addon->getNamespace());

            if (is_string($route['uses']) && !Str::contains($route['uses'], '@')) {
                $this->router->resource($uri, $route['uses']);
            } else {

                $route = $this->router->{$verb}($uri, $route)->where($constraints);

                if ($middleware) {
                    call_user_func_array([$route, 'middleware'], (array) $middleware);
                }
            }
        }
    }

    /**
     * Register the addon plugins.
     *
     * @param AddonServiceProvider $provider
     */
    protected function registerPlugins(AddonServiceProvider $provider)
    {
        if (!$plugins = $provider->getPlugins()) {
            return;
        }

        app(Dispatcher::class)->listen(
            'Anomaly\Streams\Platform\View\Event\RegisteringTwigPlugins',
            function (RegisteringTwigPlugins $event) use ($plugins) {

                $twig = $event->getTwig();

                foreach ($plugins as $plugin) {

                    if ($twig->hasExtension($plugin)) {
                        continue;
                    }

                    $twig->addExtension(app($plugin));
                }
            }
        );
    }

    /**
     * Register the addon schedules.
     *
     * @param AddonServiceProvider $provider
     */
    protected function registerSchedules(AddonServiceProvider $provider)
    {
        if (!$schedules = $provider->getSchedules()) {
            return;
        }

        foreach ($schedules as $frequency => $commands) {
            foreach (array_filter($commands) as $command => $options) {

                if (!is_array($options)) {
                    $command = $options;
                    $options = [];
                }

                if (str_is('* * * *', $frequency)) {
                    $command = $this->schedule->command($command)->cron($frequency);
                } else {

                    $parts = explode('|', $frequency);

                    $method    = camel_case(array_shift($parts));
                    $arguments = explode(',', array_shift($parts));

                    $command = call_user_func_array([$this->schedule->command($command), $method], $arguments);
                }

                foreach ($options as $option => $arguments) {

                    if (!is_array($arguments)) {
                        $option    = $arguments;
                        $arguments = [];
                    }

                    $command = call_user_func_array([$command, camel_case($option)], (array) $arguments);
                }
            }
        }
    }

    /**
     * Register view overrides.
     *
     * @param AddonServiceProvider $provider
     */
    protected function registerOverrides(AddonServiceProvider $provider)
    {
        $overrides = $provider->getOverrides();
        $mobiles   = $provider->getMobile();

        if (!$overrides && !$mobiles) {
            return;
        }

        foreach ($overrides as $view => $override) {
            $this->viewOverrides->put($view, $override);
        }

        foreach ($mobiles as $view => $override) {
            $this->viewMobileOverrides->put($view, $override);
        }
    }

    /**
     * Register middleware.
     *
     * @param AddonServiceProvider $provider
     */
    protected function registerMiddleware(AddonServiceProvider $provider)
    {
        foreach ($provider->getMiddleware() as $middleware) {
            $this->middlewares->push($middleware);
        }
    }

    /**
     * Register group middleware.
     *
     * @param AddonServiceProvider $provider
     */
    protected function registerGroupMiddleware(AddonServiceProvider $provider)
    {
        foreach ($provider->getGroupMiddleware() as $group => $middleware) {
            $this->router->pushMiddlewareToGroup($group, $middleware);
        }
    }

    /**
     * Register route middleware.
     *
     * @param AddonServiceProvider $provider
     */
    protected function registerRouteMiddleware(AddonServiceProvider $provider)
    {
        foreach ($provider->getRouteMiddleware() as $name => $class) {
            $this->router->aliasMiddleware($name, $class);
        }
    }

    /**
     * Register additional routes.
     *
     * @param AddonServiceProvider $provider
     */
    protected function registerAdditionalRoutes(AddonServiceProvider $provider)
    {
        if ($this->routesAreCached()) {
            return;
        }

        if (method_exists($provider, 'map')) {
            try {
                $this->application->call([$provider, 'map']);
            } catch (\Exception $e) {
                /*
                 * If, for whatever reason, this fails let
                 * it fail silently. Mapping additional routes
                 * could be volatile at certain application states.
                 */
            }
        }
    }

    /**
     * Check if routes are cached.
     */
    protected function routesAreCached()
    {
        if (in_array('routes', $this->cached)) {
            return true;
        }

        if (file_exists(base_path('bootstrap/cache/routes.php'))) {
            return $this->cached[] = 'routes';
        }

        return false;
    }
}
