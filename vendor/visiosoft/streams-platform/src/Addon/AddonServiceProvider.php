<?php namespace Anomaly\Streams\Platform\Addon;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Addon\Plugin\Plugin;
use Anomaly\Streams\Platform\Addon\Theme\Theme;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Traits\Macroable;

/**
 * Class AddonServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonServiceProvider
{
    use Macroable;
    use DispatchesJobs;

    /**
     * Class aliases.
     *
     * @var array
     */
    protected $aliases = [];

    /**
     * Class bindings.
     *
     * @var array
     */
    protected $bindings = [];

    /**
     * The addon commands.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * The addon command schedules.
     *
     * @var array
     */
    protected $schedules = [];

    /**
     * The addon view overrides.
     *
     * @var array
     */
    protected $overrides = [];

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [];

    /**
     * Addon routes.
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Addon API routes.
     *
     * @var array
     */
    protected $api = [];

    /**
     * Addon middleware.
     *
     * @var array
     */
    protected $middleware = [];

    /**
     * Addon group middleware.
     *
     * @var array
     */
    protected $groupMiddleware = [];

    /**
     * Addon route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [];

    /**
     * Addon event listeners.
     *
     * @var array
     */
    protected $listeners = [];

    /**
     * Addon providers.
     *
     * @var array
     */
    protected $providers = [];

    /**
     * Singleton bindings.
     *
     * @var array
     */
    protected $singletons = [];

    /**
     * The addon view overrides
     * for mobile agents only.
     *
     * @var array
     */
    protected $mobile = [];

    /**
     * The application instance.
     *
     * @var Application
     */
    protected $app;

    /**
     * The addon instance.
     *
     * @var FieldType|Module|Plugin|Theme
     */
    protected $addon;

    /**
     * Create a new AddonServiceProvider instance.
     *
     * @param Application $app
     * @param Addon       $addon
     */
    public function __construct(Application $app, Addon $addon)
    {
        $this->app   = $app;
        $this->addon = $addon;
    }

    /**
     * Get class aliases.
     *
     * @return array
     */
    public function getAliases()
    {
        return $this->aliases;
    }

    /**
     * Get class bindings.
     *
     * @return array
     */
    public function getBindings()
    {
        return $this->bindings;
    }

    /**
     * Get the singleton bindings.
     *
     * @return array
     */
    public function getSingletons()
    {
        return $this->singletons;
    }

    /**
     * Get the providers.
     *
     * @return array
     */
    public function getProviders()
    {
        return $this->providers;
    }

    /**
     * Get the addon commands.
     *
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * Get the addon command schedules.
     *
     * @return array
     */
    public function getSchedules()
    {
        return $this->schedules;
    }

    /**
     * Get the addon view overrides.
     *
     * @return array
     */
    public function getOverrides()
    {
        return $this->overrides;
    }

    /**
     * Get the mobile view overrides.
     *
     * @return array
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Ge the event listeners.
     *
     * @return array
     */
    public function getListeners()
    {
        return $this->listeners;
    }

    /**
     * Get the addon routes.
     *
     * @return array
     */
    public function getRoutes()
    {
        $routes = [];

        foreach (glob($this->addon->getPath('resources/routes/*')) as $include) {
            $include = require $include;

            if (!is_array($include)) {
                continue;
            }

            $routes = array_merge($include, $routes);
        }

        return array_merge($this->routes, $routes);
    }

    /**
     * Get the addon API routes.
     *
     * @return array
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Get the middleware.
     *
     * @return array
     */
    public function getMiddleware()
    {
        return $this->middleware;
    }

    /**
     * Get the group middleware.
     *
     * @return array
     */
    public function getGroupMiddleware()
    {
        return $this->groupMiddleware;
    }

    /**
     * Get the route middleware.
     *
     * @return array
     */
    public function getRouteMiddleware()
    {
        return $this->routeMiddleware;
    }

    /**
     * Get the addon plugins.
     *
     * @return array
     */
    public function getPlugins()
    {
        return $this->plugins;
    }
}
