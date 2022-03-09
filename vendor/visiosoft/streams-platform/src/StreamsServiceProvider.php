<?php

namespace Anomaly\Streams\Platform;

use Illuminate\Support\Str;
use Illuminate\Routing\Redirector;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Asm89\Twig\CacheExtension\Extension;
use Anomaly\Streams\Platform\Event\Ready;
use Anomaly\Streams\Platform\Event\Booted;
use Illuminate\Contracts\Cache\Repository;
use Anomaly\Streams\Platform\Event\Booting;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Field\FieldModel;
use Anomaly\Streams\Platform\Addon\AddonManager;
use Anomaly\Streams\Platform\Stream\StreamModel;
use Anomaly\Streams\Platform\Entry\EntryObserver;
use Anomaly\Streams\Platform\Field\FieldObserver;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\View\Cache\CacheKey;
use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Anomaly\Streams\Platform\Stream\StreamObserver;
use Anomaly\Streams\Platform\Model\EloquentObserver;
use Anomaly\Streams\Platform\View\Cache\CacheAdapter;
use Anomaly\Streams\Platform\View\Cache\CacheStrategy;
use Anomaly\Streams\Platform\View\ViewServiceProvider;
use Anomaly\Streams\Platform\Assignment\AssignmentModel;
use Anomaly\Streams\Platform\Assignment\AssignmentObserver;
use Anomaly\Streams\Platform\Http\Command\ConfigureRequest;
use Anomaly\Streams\Platform\Routing\Command\IncludeRoutes;
use Anomaly\Streams\Platform\Search\Command\ConfigureScout;
use Anomaly\Streams\Platform\View\Command\AddViewNamespaces;
use Anomaly\Streams\Platform\Asset\Command\AddAssetNamespaces;
use Anomaly\Streams\Platform\Image\Command\AddImageNamespaces;
use Anomaly\Streams\Platform\Entry\Command\AutoloadEntryModels;
use Anomaly\Streams\Platform\View\Event\RegisteringTwigPlugins;
use Anomaly\Streams\Platform\Addon\Theme\Command\LoadCurrentTheme;
use Anomaly\Streams\Platform\Application\Command\SetCoreConnection;
use Anomaly\Streams\Platform\Application\Command\ConfigureTranslator;
use Anomaly\Streams\Platform\Application\Command\SetApplicationDomain;
use Anomaly\Streams\Platform\Application\Command\ConfigureUriValidator;
use Anomaly\Streams\Platform\Application\Command\InitializeApplication;
use Anomaly\Streams\Platform\Application\Command\ConfigureFileCacheStore;
use Anomaly\Streams\Platform\Application\Command\LoadEnvironmentOverrides;
use Anomaly\Streams\Platform\Application\Command\LoadStreamsConfiguration;
use Illuminate\Support\Facades\Request;

/**
 * Class StreamsServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class StreamsServiceProvider extends ServiceProvider
{

    use DispatchesJobs;

    /**
     * The scheduled commands.
     *
     * @var array
     */
    protected $schedule = [];

    /**
     * The providers to register.
     *
     * @var array
     */
    protected $providers = [
        ViewServiceProvider::class,
        StreamsEventProvider::class,
        StreamsConsoleProvider::class,
    ];

    /**
     * The plugins to register.
     *
     * @var array
     */
    protected $plugins = [
        'Anomaly\Streams\Platform\StreamsPlugin',
    ];

    /**
     * The class bindings.
     *
     * @var array
     */
    public $bindings = [
        'Illuminate\Contracts\Debug\ExceptionHandler'                                    => 'Anomaly\Streams\Platform\Exception\ExceptionHandler',
        'Illuminate\Database\Migrations\MigrationRepositoryInterface'                    => 'Anomaly\Streams\Platform\Database\Migration\MigrationRepository',
        'Anomaly\Streams\Platform\Entry\EntryModel'                                      => 'Anomaly\Streams\Platform\Entry\EntryModel',
        'Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface'               => 'Anomaly\Streams\Platform\Entry\EntryRepository',
        'Anomaly\Streams\Platform\Field\FieldModel'                                      => 'Anomaly\Streams\Platform\Field\FieldModel',
        'Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface'               => 'Anomaly\Streams\Platform\Field\FieldRepository',
        'Anomaly\Streams\Platform\Stream\StreamModel'                                    => 'Anomaly\Streams\Platform\Stream\StreamModel',
        'Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface'             => 'Anomaly\Streams\Platform\Stream\StreamRepository',
        'Anomaly\Streams\Platform\Model\Contract\EloquentRepositoryInterface'            => 'Anomaly\Streams\Platform\Model\EloquentRepository',
        'Anomaly\Streams\Platform\Version\Contract\VersionRepositoryInterface'           => 'Anomaly\Streams\Platform\Version\VersionRepository',
        'Anomaly\Streams\Platform\Lock\Contract\LockRepositoryInterface'                 => 'Anomaly\Streams\Platform\Lock\LockRepository',
        'Anomaly\Streams\Platform\Assignment\AssignmentModel'                            => 'Anomaly\Streams\Platform\Assignment\AssignmentModel',
        'Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface'     => 'Anomaly\Streams\Platform\Assignment\AssignmentRepository',
        'Anomaly\Streams\Platform\Addon\Module\ModuleModel'                              => 'Anomaly\Streams\Platform\Addon\Module\ModuleModel',
        'Anomaly\Streams\Platform\Addon\Module\Contract\ModuleRepositoryInterface'       => 'Anomaly\Streams\Platform\Addon\Module\ModuleRepository',
        'Anomaly\Streams\Platform\Addon\Extension\ExtensionModel'                        => 'Anomaly\Streams\Platform\Addon\Extension\ExtensionModel',
        'Anomaly\Streams\Platform\Addon\Extension\Contract\ExtensionRepositoryInterface' => 'Anomaly\Streams\Platform\Addon\Extension\ExtensionRepository',
        'addon.collection'                                                               => 'Anomaly\Streams\Platform\Addon\AddonCollection',
        'module.collection'                                                              => 'Anomaly\Streams\Platform\Addon\Module\ModuleCollection',
        'extension.collection'                                                           => 'Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection',
        'field_type.collection'                                                          => 'Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection',
        'plugin.collection'                                                              => 'Anomaly\Streams\Platform\Addon\Plugin\PluginCollection',
        'theme.collection'                                                               => 'Anomaly\Streams\Platform\Addon\Theme\ThemeCollection',
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    public $singletons = [
        'Illuminate\Database\Migrations\Migrator'                                            => 'Anomaly\Streams\Platform\Database\Migration\Migrator',
        'Anomaly\Streams\Platform\Routing\UrlGenerator'                                      => 'url',
        'Intervention\Image\ImageManager'                                                    => 'image',
        'League\Flysystem\MountManager'                                                      => 'League\Flysystem\MountManager',
        'Illuminate\Database\Seeder'                                                         => 'Anomaly\Streams\Platform\Database\Seeder\Seeder',
        'Illuminate\Console\Scheduling\Schedule'                                             => 'Illuminate\Console\Scheduling\Schedule',
        'Anomaly\Streams\Platform\Application\Application'                                   => 'Anomaly\Streams\Platform\Application\Application',
        'Anomaly\Streams\Platform\Addon\AddonLoader'                                         => 'Anomaly\Streams\Platform\Addon\AddonLoader',
        'Anomaly\Streams\Platform\Addon\AddonBinder'                                         => 'Anomaly\Streams\Platform\Addon\AddonBinder',
        'Anomaly\Streams\Platform\Addon\AddonManager'                                        => 'Anomaly\Streams\Platform\Addon\AddonManager',
        'Anomaly\Streams\Platform\Addon\AddonIntegrator'                                     => 'Anomaly\Streams\Platform\Addon\AddonIntegrator',
        'Anomaly\Streams\Platform\Addon\AddonProvider'                                       => 'Anomaly\Streams\Platform\Addon\AddonProvider',
        'Anomaly\Streams\Platform\Addon\AddonCollection'                                     => 'Anomaly\Streams\Platform\Addon\AddonCollection',
        'Anomaly\Streams\Platform\Message\MessageBag'                                        => 'Anomaly\Streams\Platform\Message\MessageBag',
        'Anomaly\Streams\Platform\Stream\StreamStore'                                        => 'Anomaly\Streams\Platform\Stream\StreamStore',
        'Anomaly\Streams\Platform\Support\Configurator'                                      => 'Anomaly\Streams\Platform\Support\Configurator',
        'Anomaly\Streams\Platform\Support\Authorizer'                                        => 'Anomaly\Streams\Platform\Support\Authorizer',
        'Anomaly\Streams\Platform\Support\Evaluator'                                         => 'Anomaly\Streams\Platform\Support\Evaluator',
        'Anomaly\Streams\Platform\Support\Currency'                                          => 'Anomaly\Streams\Platform\Support\Currency',
        'Anomaly\Streams\Platform\Support\Parser'                                            => 'Anomaly\Streams\Platform\Support\Parser',
        'Anomaly\Streams\Platform\Support\Hydrator'                                          => 'Anomaly\Streams\Platform\Support\Hydrator',
        'Anomaly\Streams\Platform\Support\Resolver'                                          => 'Anomaly\Streams\Platform\Support\Resolver',
        'Anomaly\Streams\Platform\Support\Translator'                                        => 'Anomaly\Streams\Platform\Support\Translator',
        'Anomaly\Streams\Platform\Asset\Asset'                                               => 'Anomaly\Streams\Platform\Asset\Asset',
        'Anomaly\Streams\Platform\Asset\AssetPaths'                                          => 'Anomaly\Streams\Platform\Asset\AssetPaths',
        'Anomaly\Streams\Platform\Asset\AssetParser'                                         => 'Anomaly\Streams\Platform\Asset\AssetParser',
        'Anomaly\Streams\Platform\Asset\AssetFilters'                                        => 'Anomaly\Streams\Platform\Asset\AssetFilters',
        'Anomaly\Streams\Platform\Image\Image'                                               => 'Anomaly\Streams\Platform\Image\Image',
        'Anomaly\Streams\Platform\Image\ImagePaths'                                          => 'Anomaly\Streams\Platform\Image\ImagePaths',
        'Anomaly\Streams\Platform\Image\ImageMacros'                                         => 'Anomaly\Streams\Platform\Image\ImageMacros',
        'Anomaly\Streams\Platform\Exception\ExceptionIdentifier'                             => 'Anomaly\Streams\Platform\Exception\ExceptionIdentifier',
        'Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionRegistry'                  => 'Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionRegistry',
        'Anomaly\Streams\Platform\Ui\Table\Component\View\ViewRegistry'                      => 'Anomaly\Streams\Platform\Ui\Table\Component\View\ViewRegistry',
        'Anomaly\Streams\Platform\Ui\Table\Component\Filter\FilterRegistry'                  => 'Anomaly\Streams\Platform\Ui\Table\Component\Filter\FilterRegistry',
        'Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection'                        => 'Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection',
        'Anomaly\Streams\Platform\Ui\Icon\IconRegistry'                                      => 'Anomaly\Streams\Platform\Ui\Icon\IconRegistry',
        'Anomaly\Streams\Platform\Ui\Button\ButtonRegistry'                                  => 'Anomaly\Streams\Platform\Ui\Button\ButtonRegistry',
        'Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\SectionCollection'       => 'Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\SectionCollection',
        'Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\NavigationCollection' => 'Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\NavigationCollection',
        'Anomaly\Streams\Platform\Http\Middleware\MiddlewareCollection'                      => 'Anomaly\Streams\Platform\Http\Middleware\MiddlewareCollection',
        'Anomaly\Streams\Platform\Stream\StreamModel'                                        => 'Anomaly\Streams\Platform\Stream\StreamModel',
        'Anomaly\Streams\Platform\Addon\Module\ModuleCollection'                             => 'Anomaly\Streams\Platform\Addon\Module\ModuleCollection',
        'Anomaly\Streams\Platform\Addon\Module\Listener\PutModuleInCollection'               => 'Anomaly\Streams\Platform\Addon\Module\Listener\PutModuleInCollection',
        'Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection'                       => 'Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection',
        'Anomaly\Streams\Platform\Addon\Extension\Listener\PutExtensionInCollection'         => 'Anomaly\Streams\Platform\Addon\Extension\Listener\PutExtensionInCollection',
        'Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier'                         => 'Anomaly\Streams\Platform\Addon\FieldType\FieldTypeModifier',
        'Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection'                       => 'Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection',
        'Anomaly\Streams\Platform\Addon\FieldType\Listener\PutFieldTypeInCollection'         => 'Anomaly\Streams\Platform\Addon\FieldType\Listener\PutFieldTypeInCollection',
        'Anomaly\Streams\Platform\Addon\Plugin\PluginCollection'                             => 'Anomaly\Streams\Platform\Addon\Plugin\PluginCollection',
        'Anomaly\Streams\Platform\Addon\Plugin\Listener\PutPluginInCollection'               => 'Anomaly\Streams\Platform\Addon\Plugin\Listener\PutPluginInCollection',
        'Anomaly\Streams\Platform\Addon\Theme\ThemeCollection'                               => 'Anomaly\Streams\Platform\Addon\Theme\ThemeCollection',
        'Anomaly\Streams\Platform\Addon\Theme\Listener\PutThemeInCollection'                 => 'Anomaly\Streams\Platform\Addon\Theme\Listener\PutThemeInCollection',
        'Anomaly\Streams\Platform\View\ViewComposer'                                         => 'Anomaly\Streams\Platform\View\ViewComposer',
        'Anomaly\Streams\Platform\View\ViewTemplate'                                         => 'Anomaly\Streams\Platform\View\ViewTemplate',
        'Anomaly\Streams\Platform\View\ViewIncludes'                                         => 'Anomaly\Streams\Platform\View\ViewIncludes',
        'Anomaly\Streams\Platform\View\ViewOverrides'                                        => 'Anomaly\Streams\Platform\View\ViewOverrides',
        'Anomaly\Streams\Platform\View\ViewMobileOverrides'                                  => 'Anomaly\Streams\Platform\View\ViewMobileOverrides',
        'Anomaly\Streams\Platform\View\Listener\LoadTemplateData'                            => 'Anomaly\Streams\Platform\View\Listener\LoadTemplateData',
        'Anomaly\Streams\Platform\View\Listener\DecorateData'                                => 'Anomaly\Streams\Platform\View\Listener\DecorateData',
        'Anomaly\Streams\Platform\Support\Template'                                          => 'Anomaly\Streams\Platform\Support\Template',
        'Anomaly\Streams\Platform\Support\Purifier'                                          => 'Anomaly\Streams\Platform\Support\Purifier',
        'Anomaly\Streams\Platform\Assignment\AssignmentRouter'                               => 'Anomaly\Streams\Platform\Assignment\AssignmentRouter',
        'Anomaly\Streams\Platform\Field\FieldRouter'                                         => 'Anomaly\Streams\Platform\Field\FieldRouter',
    ];

    /**
     * Boot the service provider.
     */
    public function boot(Dispatcher $events)
    {
        if (Request::segment(1) !== 'admin' && env('INSTALLED') === 'admin') {

            $this->dispatchNow(new SetCoreConnection());
            $this->dispatchNow(new AutoloadEntryModels());
            $this->dispatchNow(new InitializeApplication());

            return;
        }

        $events->dispatch(new Booting());

        // Next take care of core utilities.
        $this->dispatchNow(new SetCoreConnection());
        $this->dispatchNow(new ConfigureUriValidator());
        $this->dispatchNow(new InitializeApplication());

        // Load application specific .env file.
        $this->dispatchNow(new LoadEnvironmentOverrides());

        // Setup and preparing utilities.
        $this->dispatchNow(new LoadStreamsConfiguration());
        $this->dispatchNow(new ConfigureFileCacheStore());
        $this->dispatchNow(new ConfigureTranslator());
        $this->dispatchNow(new AutoloadEntryModels());
        $this->overrideUrlSingleton();
        $this->dispatchNow(new AddAssetNamespaces());
        $this->dispatchNow(new AddImageNamespaces());
        $this->dispatchNow(new ConfigureRequest());
        $this->dispatchNow(new ConfigureScout());

        // Observe our base models.
        EntryModel::observe(EntryObserver::class);
        FieldModel::observe(FieldObserver::class);
        StreamModel::observe(StreamObserver::class);
        EloquentModel::observe(EloquentObserver::class);
        AssignmentModel::observe(AssignmentObserver::class);

        /**
         * Boot event is used to help scheduler
         * and artisan command registering.
         */
        $this->app->booted(
            function () use ($events) {

                $events->dispatch(new Booted());

                /* @var Schedule $schedule */
                $schedule = $this->app->make(Schedule::class);

                foreach (array_merge($this->schedule, config('streams.schedules', [])) as $frequency => $commands) {
                    foreach (array_filter($commands) as $command) {

                        if (Str::contains($frequency, ' ')) {
                            $schedule->command($command)->cron($frequency);
                        }

                        if (!Str::contains($frequency, ' ')) {
                            $schedule->command($command)->{Str::camel($frequency)}();
                        }
                    }
                }

                /* @var AddonManager $manager */
                $manager = $this->app->make('Anomaly\Streams\Platform\Addon\AddonManager');

                /* @var Dispatcher $events */
                $events = $this->app->make('Illuminate\Contracts\Events\Dispatcher');

                $events->listen(
                    'Anomaly\Streams\Platform\View\Event\RegisteringTwigPlugins',
                    function (RegisteringTwigPlugins $event) {
                        $twig = $event->getTwig();

                        foreach ($this->plugins as $plugin) {
                            if (!$twig->hasExtension($plugin)) {
                                $twig->addExtension($this->app->make($plugin));
                            }
                        }

                        $twig->addExtension(
                            new Extension(
                                new CacheStrategy(
                                    new CacheAdapter($this->app->make(Repository::class)),
                                    new CacheKey()
                                )
                            )
                        );
                    }
                );

                $manager->register();

                // Set the timezone for PHP.
                date_default_timezone_set(config('app.timezone'));

                /*
                 * Do this after addons are registered
                 * so that they can override named routes.
                 */
                $this->dispatchNow(new IncludeRoutes());

                $this->dispatchNow(new LoadCurrentTheme());
                $this->dispatchNow(new AddViewNamespaces());
                $this->dispatchNow(new SetApplicationDomain());

                /*
                 * Do this after addons are registered
                 * so that they can override named routes.
                 */
                $this->dispatchNow(new IncludeRoutes());

                $events->dispatch(new Ready());
            }
        );

        /**
         * Fire this last cause it causes some
         * issues with configuration and sessions.
         */
        if (config('app.debug') && config('debugbar.enabled')) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if (Request::segment(1) !== 'admin' && env('INSTALLED') === 'admin') {

            /**
             * Fallback to database users.
             */
            config([
                'auth.providers.users.driver' => 'database',
                'auth.providers.users.table' => 'users_users',
            ]);

            return;
        }

        /**
         * When config is cached by Laravel we
         * end up oddly not loading .env data.
         */
        if (is_file(base_path('bootstrap/cache/config.php')) && is_file($file = base_path('.env'))) {
            foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {

                // Check for # comments.
                if (!starts_with($line, '#')) {
                    putenv($line);
                }
            }
        }

        /*
         * Register all third party packages first.
         */
        $this->app->register(\Laravel\Scout\ScoutServiceProvider::class);
        $this->app->register(\Barryvdh\HttpCache\ServiceProvider::class);
        $this->app->register(\Collective\Html\HtmlServiceProvider::class);
        $this->app->register(\Intervention\Image\ImageServiceProvider::class);

        // Register listeners.
        $events = $this->app->make(Dispatcher::class);

        foreach (config('streams.listeners', []) as $event => $listeners) {

            foreach ($listeners as $key => $listener) {
                if (is_integer($listener)) {
                    $priority = $listener;
                    $listener = $key;
                } else {
                    $priority = 0;
                }

                $events->listen($event, $listener, $priority);
            }
        }

        /**
         * Merge mindings with config and leave
         * for Laravel to handle this later.
         */
        $this->bindings = array_merge($this->bindings, config('streams.bindings', []));
        $this->singletons = array_merge($this->singletons, config('streams.singletons', []));

        // Register streams other providers.
        foreach (array_merge($this->providers, config('streams.providers', [])) as $provider) {
            $this->app->register($provider);
        }

        /*
         * Change the default language path so
         * that there MUST be a prefix hint.w
         */
        $this->app->singleton(
            'path.lang',
            function () {
                return realpath(__DIR__ . '/../resources/lang');
            }
        );

        /*
         * Register the path to the streams platform.
         * This is handy for helping load other streams things.
         */
        $this->app->instance(
            'streams.path',
            $this->app->make('path.base') . '/vendor/visiosoft/streams-platform'
        );

        /*
         * If we don't have an .env file we need to head
         * to the installer (unless that's where we're at).
         */
        if (!env('INSTALLED') && $this->app->make('request')->segment(1) !== 'installer') {
            $this->app->make('router')->any(
                '{url?}',
                function (Redirector $redirector) {
                    return $redirector->to('installer');
                }
            )->where(['url' => '(.*)']);

            return;
        }

        /**
         * Cache a couple files we may use heavily.
         */
        $this->app->singleton(
            'composer.json',
            function () {
                return json_decode(file_get_contents(base_path('composer.json')), true);
            }
        );

        $this->app->singleton(
            'composer.lock',
            function () {
                return json_decode(file_get_contents(base_path('composer.lock')), true);
            }
        );

        /**
         * Correct path for Paginator.
         */
        Paginator::currentPathResolver(
            function () {
                return $this->app->make(UrlGenerator::class)->current();
            }
        );

        /*
         * Register system routes.
         */
        $this->app->make('router')->post(
            'form/handle/{key}',
            [
                'ttl'  => 0,
                'uses' => 'Anomaly\Streams\Platform\Http\Controller\FormController@handle',
            ]
        );

        $this->app->make('router')->get(
            'entry/handle/restore/{addon}/{namespace}/{stream}/{id}',
            [
                'ttl'  => 0,
                'uses' => 'Anomaly\Streams\Platform\Http\Controller\EntryController@restore',
            ]
        );

        $this->app->make('router')->get(
            'entry/handle/export/{addon}/{namespace}/{stream}',
            [
                'ttl'  => 0,
                'uses' => 'Anomaly\Streams\Platform\Http\Controller\EntryController@export',
            ]
        );

        $this->app->make('router')->get(
            'locks/touch',
            [
                'ttl'  => 0,
                'uses' => 'Anomaly\Streams\Platform\Http\Controller\LocksController@touch',
            ]
        );

        $this->app->make('router')->get(
            'locks/release',
            [
                'ttl'  => 0,
                'uses' => 'Anomaly\Streams\Platform\Http\Controller\LocksController@release',
            ]
        );
    }

    protected function overrideUrlSingleton()
    {
        $this->app->singleton('url', function ($app) {
            $routes = $app['router']->getRoutes();

            $url = new \Anomaly\Streams\Platform\Routing\UrlGenerator(
                $routes,
                $app->rebinding(
                    'request',
                    function ($app, $request) {
                        $app['url']->setRequest($request);
                    }
                )
            );

            // Next we will set a few service resolvers on the URL generator so it can
            // get the information it needs to function. This just provides some of
            // the convenience features to this URL generator like "signed" URLs.
            $url->setSessionResolver(function () {
                return $this->app['session'];
            });

            $url->setKeyResolver(function () {
                return $this->app->make('config')->get('app.key');
            });

            // If the route collection is "rebound", for example, when the routes stay
            // cached for the application, we will need to rebind the routes on the
            // URL generator instance so it has the latest version of the routes.
            $app->rebinding('routes', function ($app, $routes) {
                $app['url']->setRoutes($routes);
            });

            return $url;
        });
    }
}
