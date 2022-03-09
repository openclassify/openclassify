<?php namespace Anomaly\Streams\Platform\View;

use Anomaly\Streams\Platform\View\Twig\Bridge;
use Anomaly\Streams\Platform\View\Twig\Compiler;
use Anomaly\Streams\Platform\View\Twig\Engine;
use Anomaly\Streams\Platform\View\Twig\Loader;
use InvalidArgumentException;
use Twig_Loader_Array;
use Twig_Loader_Chain;

/**
 * Class ViewServiceProvider
 *
 * This is adopted from https://github.com/rcrowe/TwigBridge
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ViewServiceProvider extends \Illuminate\View\ViewServiceProvider
{

    /**
     * Register the service.
     */
    public function register()
    {
        //$this->registerCommands();
        $this->registerOptions();
        $this->registerLoaders();
        $this->registerEngine();
        $this->registerAliases();
    }

    /**
     * Boot the service.
     */
    public function boot()
    {
        $this->loadConfiguration();
        $this->registerExtension();
    }

    /**
     * Check if we are running on PHP 7.
     *
     * @return bool
     */
    protected function isRunningOnPhp7()
    {
        return version_compare(PHP_VERSION, '7.0-dev', '>=');
    }

    /**
     * Load the configuration files and allow them to be published.
     *
     * @return void
     */
    protected function loadConfiguration()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../resources/config/twig.php', 'twig');
    }

    /**
     * Register the Twig extension in the Laravel View component.
     *
     * @return void
     */
    protected function registerExtension()
    {
        $this->app['view']->addExtension(
            $this->app['twig.extension'],
            'twig',
            function () {
                return $this->app['twig.engine'];
            }
        );
    }

    /**
     * Register console command bindings.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->app->bindIf(
            'command.twig',
            function () {
                return new Command\TwigBridge;
            }
        );

        $this->app->bindIf(
            'command.twig.clean',
            function () {
                return new Command\Clean;
            }
        );

        $this->app->bindIf(
            'command.twig.lint',
            function () {
                return new Command\Lint;
            }
        );

        $this->commands(
            'command.twig',
            'command.twig.clean',
            'command.twig.lint'
        );
    }

    /**
     * Register Twig config option bindings.
     *
     * @return void
     */
    protected function registerOptions()
    {
        $this->app->bindIf(
            'twig.extension',
            function () {
                return $this->app['config']->get('twig.twig.extension');
            }
        );

        $this->app->bindIf(
            'twig.options',
            function () {
                $options = $this->app['config']->get('twig.twig.environment', []);
                // Check whether we have the cache path set
                if (!isset($options['cache']) || is_null($options['cache'])) {
                    // No cache path set for Twig, lets set to the Laravel views storage folder
                    $options['cache'] = storage_path('framework/views/twig');
                }

                return $options;
            }
        );

        $this->app->bindIf(
            'twig.extensions',
            function () {
                $load = $this->app['config']->get('twig.extensions.enabled', []);
                // Is debug enabled?
                // If so enable debug extension
                $options = $this->app['twig.options'];
                $isDebug = (bool)(isset($options['debug'])) ? $options['debug'] : false;
                if ($isDebug) {
                    array_unshift($load, 'Twig_Extension_Debug');
                }

                return $load;
            }
        );

        $this->app->bindIf(
            'twig.lexer',
            function () {
                return null;
            }
        );
    }

    /**
     * Register Twig loader bindings.
     *
     * @return void
     */
    protected function registerLoaders()
    {
        // The array used in the ArrayLoader
        $this->app->bindIf(
            'twig.templates',
            function () {
                return [];
            }
        );

        $this->app->bindIf(
            'twig.loader.array',
            function ($app) {
                return new Twig_Loader_Array($app['twig.templates']);
            }
        );

        $this->app->bindIf(
            'twig.loader.viewfinder',
            function ($app) {
                return $app->make(
                    Loader::class,
                    [
                        'files'     => $app['files'],
                        'finder'    => $app['view']->getFinder(),
                        'extension' => $app['twig.extension'],
                    ]
                );
            }
        );

        $this->app->bindIf(
            'twig.loader',
            function () {
                return new Twig_Loader_Chain(
                    [
                        $this->app['twig.loader.array'],
                        $this->app['twig.loader.viewfinder'],
                    ]
                );
            },
            true
        );
    }

    /**
     * Register Twig engine bindings.
     *
     * @return void
     */
    protected function registerEngine()
    {
        $this->app->bindIf(
            'twig',
            function () {
                $extensions = $this->app['twig.extensions'];
                $lexer      = $this->app['twig.lexer'];
                $twig       = new Bridge(
                    $this->app['twig.loader'],
                    $this->app['twig.options'],
                    $this->app
                );

                // Instantiate and add extensions
                foreach ($extensions as $extension) {
                    // Get an instance of the extension
                    // Support for string, closure and an object
                    if (is_string($extension)) {
                        try {
                            $extension = $this->app->make($extension);
                        } catch (\Exception $e) {
                            throw new InvalidArgumentException(
                                "Cannot instantiate Twig extension '$extension': " . $e->getMessage()
                            );
                        }
                    } elseif (is_callable($extension)) {
                        $extension = $extension($this->app, $twig);
                    } elseif (!is_a($extension, 'Twig_Extension')) {
                        throw new InvalidArgumentException('Incorrect extension type');
                    }
                    $twig->addExtension($extension);
                }
                // Set lexer
                if (is_a($lexer, 'Twig_LexerInterface')) {
                    $twig->setLexer($lexer);
                }

                return $twig;
            },
            true
        );
        $this->app->alias('twig', 'Twig_Environment');
        $this->app->alias('twig', Bridge::class);
        $this->app->bindIf(
            'twig.compiler',
            function () {
                return new Compiler($this->app['twig']);
            }
        );
        $this->app->bindIf(
            'twig.engine',
            function () {
                return new Engine(
                    $this->app['twig.compiler'],
                    $this->app['twig.loader.viewfinder'],
                    $this->app['config']->get('twig.twig.globals', [])
                );
            }
        );
    }

    /**
     * Register aliases for classes that had to be renamed because of reserved names in PHP7.
     *
     * @return void
     */
    protected function registerAliases()
    {
        if (!$this->isRunningOnPhp7() and !class_exists('TwigBridge\Extension\Laravel\String')) {
            class_alias('TwigBridge\Extension\Laravel\Str', 'TwigBridge\Extension\Laravel\String');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.twig',
            'command.twig.clean',
            'command.twig.lint',
            'twig.extension',
            'twig.options',
            'twig.extensions',
            'twig.lexer',
            'twig.templates',
            'twig.loader.array',
            'twig.loader.viewfinder',
            'twig.loader',
            'twig',
            'twig.compiler',
            'twig.engine',
        ];
    }
}
