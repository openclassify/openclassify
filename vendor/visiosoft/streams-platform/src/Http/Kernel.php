<?php namespace Anomaly\Streams\Platform\Http;

use Anomaly\Streams\Platform\Addon\Module\Module;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Facade;

/**
 * Class Kernel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Kernel extends \Illuminate\Foundation\Http\Kernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Illuminate\Cookie\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Anomaly\Streams\Platform\Http\Middleware\ProxySession::class,
        /**
         * This needs work yet. Currently the CacheRequests
         * cause circular issues OR drop sessions if not
         * directly overridden on our end.
         */
        //\Anomaly\Streams\Platform\Http\Middleware\CacheRequests::class,
        //\Barryvdh\HttpCache\Middleware\ParseEsi::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'can'        => \Illuminate\Auth\Middleware\Authorize::class,
        'auth'       => \Illuminate\Auth\Middleware\Authenticate::class,
        'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'bindings'   => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        //'guest' => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            //\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Anomaly\Streams\Platform\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * Create a new Kernel instance.
     *
     * @param Application $app
     * @param Router $router
     */
    public function __construct(Application $app, Router $router)
    {
        $this->defineLocale();
        $this->rewriteAdmin();

        $config = require base_path('config/streams.php');

        $middleware         = array_get($config, 'middleware', []);
        $routeMiddleware    = array_get($config, 'route_middleware', []);
        $middlewareGroups   = array_get($config, 'middleware_groups', []);
        $middlewarePriority = array_get($config, 'middleware_priority', []);

        $this->middleware         = array_merge($this->middleware, $middleware);
        $this->routeMiddleware    = array_merge($this->routeMiddleware, $routeMiddleware);
        $this->middlewareGroups   = array_merge($this->middlewareGroups, $middlewareGroups);
        $this->middlewarePriority = array_merge($this->middlewarePriority, $middlewarePriority);

        if (!defined('IS_ADMIN')) {
            define('IS_ADMIN', starts_with(array_get($_SERVER, 'REQUEST_URI', ''), '/admin'));
        }

        parent::__construct($app, $router);
    }

    /**
     * Add a middleware group and sync.
     *
     * @param $group
     * @param array $middleware
     */
    public function addMiddlewareGroup($group, $middleware = []) {
        
        $this->middlewareGroups[$group] = $middleware;

        $this->syncMiddlewareToRouter();
    }

    /**
     * Send the request through the router.
     *
     * This is the same as the parent logic
     * with the exception of "routeAutomatically"
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendRequestThroughRouter($request)
    {
        $this->app->instance('request', $request);

        Facade::clearResolvedInstance('request');

        $this->bootstrap();

        $this->routeAutomatically($request);

        return parent::sendRequestThroughRouter($request);
    }

    /**
     * Attempt to route the request automatically.
     *
     * Huge thanks to @frednwt for this one.
     *
     * @param Request $request
     */
    protected function routeAutomatically(Request $request)
    {

        /**
         * This only applies to admin
         * controllers at this time.
         */
        if ($request->segment(1) !== 'admin') {
            return;
        }

        /**
         * Use the segments to figure
         * out what we need to do.
         */
        $segments = $request->segments();

        /**
         * Remove "admin"
         * from beginning.
         */
        array_shift($segments);

        /**
         * This is just /admin
         */
        if (!$segments) {
            return;
        }

        /**
         * The first segment MUST
         * be a unique addon slug.
         *
         * @var Module $module
         */
        if (!$addon = app('module.collection')->get($segments[0])) {
            return;
        }

        $namespace = (new \ReflectionClass($addon))->getNamespaceName();

        $controller = null;
        $module     = null;
        $stream     = null;
        $method     = null;
        $path       = null;
        $id         = null;


        if (count($segments) == 1) {
            $module = $segments[0];
            $stream = $segments[0];
            $method = 'index';

            $path = implode('/', ['admin', $module]);

            $controller = ucfirst(studly_case($stream)) . 'Controller';
            $controller = $namespace . '\Http\Controller\Admin\\' . $controller;
        }

        if (count($segments) == 2) {
            $module = $segments[0];
            $stream = $segments[1];
            $method = 'index';

            $path = implode('/', ['admin', $module, $stream]);

            $controller = ucfirst(studly_case($stream)) . 'Controller';
            $controller = $namespace . '\Http\Controller\Admin\\' . $controller;

            if (!class_exists($controller)) {
                $controller = null;
            }
        }

        if (!$controller && count($segments) == 2) {
            $module = $segments[0];
            $stream = $segments[0];
            $method = $segments[1];

            $path = implode('/', array_unique(['admin', $module, $stream, $method]));

            $controller = ucfirst(studly_case($stream)) . 'Controller';
            $controller = $namespace . '\Http\Controller\Admin\\' . $controller;
        }

        if (count($segments) == 3) {
            $module = $segments[0];
            $stream = $segments[1];
            $method = $segments[2];

            $path = implode('/', ['admin', $module, $stream, $method]);

            $controller = ucfirst(studly_case($stream)) . 'Controller';
            $controller = $namespace . '\Http\Controller\Admin\\' . $controller;

            if (!class_exists($controller)) {
                $controller = null;
            }
        }

        if (!$controller && count($segments) == 3) {
            $module = $segments[0];
            $stream = $segments[0];
            $method = $segments[1];
            $id     = '{id}';

            $path = implode('/', array_unique(['admin', $module, $stream, $method, $id]));

            $controller = ucfirst(studly_case($stream)) . 'Controller';
            $controller = $namespace . '\Http\Controller\Admin\\' . $controller;
        }

        if (count($segments) == 4) {
            $module = $segments[0];
            $stream = $segments[1];
            $method = $segments[2];
            $id     = '{id}';

            $path = implode('/', ['admin', $module, $stream, $method, $id]);

            $controller = ucfirst(studly_case($stream)) . 'Controller';
            $controller = $namespace . '\Http\Controller\Admin\\' . $controller;
        }

        /* @var Router $router */
        $router = app('router');

        /**
         * If the route has already been
         * defined then let it handle itself.
         */
        try {
            $router->getRoutes()->match($request);

            return;
        } catch (\Exception $exception) {
            // Not found. Onward!
        }

        if (!class_exists($controller)) {
            return;
        }

        $router->any(
            $path,
            [
                'streams::addon' => $addon->getNamespace(),
                'uses'           => $controller . '@' . $method,
            ]
        );
    }

    /**
     * Define the locale
     * based on our URI.
     *
     * Huge thanks to @keevitaja for this one.
     *
     * @link https://github.com/keevitaja/linguist
     */
    protected function defineLocale()
    {
        /*
         * Make sure the ORIGINAL_REQUEST_URI is always available
         * Overwrite later as necessary
         */
        $_SERVER['ORIGINAL_REQUEST_URI'] = array_get($_SERVER, 'REQUEST_URI');

        /*
         * First grab the supported i18n locales
         * that we should be looking for.
         */
        $locales = require __DIR__ . '/../../resources/config/locales.php';

        if (file_exists($override = __DIR__ . '/../../../../../resources/core/config/streams/locales.php')) {
            $locales = array_replace_recursive($locales, require $override);
        }

        if (!$hint = array_get($locales, 'hint')) {
            return;
        }

        /*
         * Check the domain for a locale.
         */
        $url = parse_url(array_get($_SERVER, 'HTTP_HOST'));

        if ($url === false) {
            throw new \Exception('Malformed URL: ' . $url);
        }

        $host = array_get($url, 'host');

        $pattern = '/^(' . implode('|', array_keys($locales['supported'])) . ')(\.)./';

        if ($host && ($hint === 'domain' || $hint === true) && preg_match($pattern, $host, $matches)) {

            define('LOCALE', $matches[1]);

            return;
        }

        /*
         * Let's first look in the URI
         * path for for a locale.
         */
        $pattern = '/^\/(' . implode('|', array_keys($locales['supported'])) . ')(\/|(?:$)|(?=\?))/';

        $uri = array_get($_SERVER, 'REQUEST_URI', filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL));

        if (($hint === 'uri' || $hint === true) && preg_match($pattern, $uri, $matches)) {

            $_SERVER['ORIGINAL_REQUEST_URI'] = $uri;
            $_SERVER['REQUEST_URI']          = preg_replace($pattern, '/', $uri);

            define('LOCALE', $matches[1]);

            return;
        }
    }

    /**
     * Rewrite the admin URI based on
     * configured admin URI segment.
     */
    protected function rewriteAdmin()
    {
        // Our admin segment.
        $segment = 'admin';

        /**
         * Skip if our admin
         * segment is admin.
         */
        if ($segment == 'admin') {
            return;
        }

        /**
         * If we have a configured admin
         * slug then make sure we are not
         * accessing the original segment.
         */
        $pattern = '/^\/(admin)(?=\/?)/';

        $uri = array_get($_SERVER, 'REQUEST_URI', filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL));

        if (preg_match($pattern, $uri, $matches)) {
            abort(404);
        }

        /**
         * Now rewrite the admin segment
         * based on the configured value.
         */
        $pattern = '/^\/(' . $segment . ')(?=\/?)/';

        $uri = array_get($_SERVER, 'REQUEST_URI', filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL));

        if (preg_match($pattern, $uri, $matches)) {

            $_SERVER['ORIGINAL_REQUEST_URI'] = $uri;
            $_SERVER['REQUEST_URI']          = preg_replace($pattern, '/admin', $uri);
        }
    }
}
