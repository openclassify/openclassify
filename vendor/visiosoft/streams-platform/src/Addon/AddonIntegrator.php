<?php namespace Anomaly\Streams\Platform\Addon;

use Anomaly\Streams\Platform\Addon\Event\AddonWasRegistered;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Addon\Module\Module;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Support\Configurator;
use Anomaly\Streams\Platform\View\Event\RegisteringTwigPlugins;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\View\Factory;
use Twig_ExtensionInterface;

/**
 * Class AddonIntegrator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddonIntegrator
{

    /**
     * The view factory.
     *
     * @var Factory
     */
    protected $views;

    /**
     * The addon provider.
     *
     * @var AddonProvider
     */
    protected $provider;

    /**
     * The IoC container.
     *
     * @var Container
     */
    protected $container;

    /**
     * The addon collection.
     *
     * @var AddonCollection
     */
    protected $collection;

    /**
     * The application instance.
     *
     * @var Application
     */
    protected $application;

    /**
     * The configurator utility.
     *
     * @var Configurator
     */
    protected $configurator;

    /**
     * Create a new AddonIntegrator instance.
     *
     * @param Factory $views
     * @param Container $container
     * @param AddonProvider $provider
     * @param Application $application
     * @param Configurator $configurator
     * @param AddonCollection $collection
     * @internal param Asset $asset
     * @internal param Image $image
     */
    public function __construct(
        Factory $views,
        Container $container,
        AddonProvider $provider,
        Application $application,
        Configurator $configurator,
        AddonCollection $collection
    ) {
        $this->views        = $views;
        $this->provider     = $provider;
        $this->container    = $container;
        $this->collection   = $collection;
        $this->application  = $application;
        $this->configurator = $configurator;
    }

    /**
     * Register an addon.
     *
     * @param         $path
     * @param         $namespace
     * @param boolean $enabled
     * @param boolean $installed
     * @return Addon|Extension|Module|Twig_ExtensionInterface
     */
    public function register($path, $namespace, $enabled, $installed)
    {
        if (!is_dir($path)) {
            return null;
        }

        list($vendor, $type, $slug) = explode('.', $namespace);

        $class = studly_case($vendor) . '\\' . studly_case($slug) . studly_case($type) . '\\' . studly_case(
                $slug
            ) . studly_case($type);

        /* @var Addon|Module|Extension|Twig_ExtensionInterface $addon */
        if (!class_exists($class)) {
            return null;
        }

        $addon = app($class)
            ->setPath($path)
            ->setType($type)
            ->setSlug($slug)
            ->setVendor($vendor);

        // If the addon supports states - set the state now.
        if ($addon->getType() === 'module' || $addon->getType() === 'extension') {
            $addon->setInstalled($installed);
            $addon->setEnabled($enabled);
        }

        // Bind to the service container.
        $this->container->alias($addon->getNamespace(), $alias = get_class($addon));
        $this->container->instance($alias, $addon);

        // Load package configuration.
        if (!file_exists(base_path('bootstrap/cache/config.php'))) {

            $this->configurator->addNamespace($addon->getNamespace(), $addon->getPath('resources/config'));

            // Load published overrides.
            $this->configurator->addNamespaceOverrides(
                $addon->getNamespace(),
                base_path(
                    'resources/addons/'
                    . $addon->getVendor() . '/'
                    . $addon->getSlug() . '-'
                    . $addon->getType()
                    . '/config'
                )
            );
        }

        // Load application overrides.
        $this->configurator->addNamespaceOverrides(
            $addon->getNamespace(),
            $this->application->getResourcesPath(
                'addons/'
                . $addon->getVendor() . '/'
                . $addon->getSlug() . '-'
                . $addon->getType()
                . '/config'
            )
        );

        // Continue loading things.
        $this->provider->register($addon);

        // Add the view / translation namespaces.
        $this->views->addNamespace(
            $addon->getNamespace(),
            [
                $this->application->getResourcesPath(
                    "addons/{$addon->getVendor()}/{$addon->getSlug()}-{$addon->getType()}/views/"
                ),
                base_path("resources/addons/{$addon->getVendor()}/{$addon->getSlug()}-{$addon->getType()}/views/"),
                $addon->getPath('resources/views'),
            ]
        );
        trans()->addNamespace($addon->getNamespace(), $addon->getPath('resources/lang'));

        /*
         * If the addon is a plugin then
         * load it into Twig when appropriate.
         */
        if ($addon->getType() === 'plugin') {
            app(Dispatcher::class)->listen(
                'Anomaly\Streams\Platform\View\Event\RegisteringTwigPlugins',
                function (RegisteringTwigPlugins $event) use ($addon) {

                    $twig = $event->getTwig();

                    if ($twig->hasExtension(get_class($addon))) {
                        return;
                    }

                    $twig->addExtension($addon);
                }
            );
        }

        $this->collection->put($addon->getNamespace(), $addon);

        event(new AddonWasRegistered($addon));

        return $addon;
    }

    /**
     * Finish up addon integration.
     */
    public function finish()
    {
        $this->provider->boot();
    }
}
