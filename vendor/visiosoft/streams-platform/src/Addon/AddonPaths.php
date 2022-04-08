<?php namespace Anomaly\Streams\Platform\Addon;

use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Contracts\Config\Repository;

/**
 * Class AddonPaths
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class AddonPaths
{

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * The stream application.
     *
     * @var Application
     */
    protected $application;

    /**
     * Create a new AddonPaths instance.
     *
     * @param Application $application
     * @param Repository $config
     */
    public function __construct(Application $application, Repository $config)
    {
        $this->config      = $config;
        $this->application = $application;
    }


    /**
     * Return all addon paths in a given folder.
     *
     * @return array
     */
    public function all()
    {
        $eager    = $this->eager();
        $deferred = $this->deferred();

        $core        = $this->core() ?: [];
        $shared      = $this->shared() ?: [];
        $application = $this->application() ?: [];
        $native = $this->native() ?: [];

        // Testing only addons.
        $testing = $this->testing() ?: [];

        // Other configured addons.
        $configured = $this->configured() ?: [];

        /*
         * Merge the eager and deferred
         * onto the front and back of
         * the paths respectively.
         */
        return array_unique(
            array_merge(
                $eager,
                array_reverse(
                    array_unique(
                        array_reverse(
                            array_merge(
                                array_filter(
                                    array_merge($native, $core, $shared, $application, $configured, $testing)
                                ),
                                $deferred
                            )
                        )
                    )
                )
            )
        );
    }

    /**
     * Return paths to eager loaded addons.
     *
     * @return array
     */
    protected function eager()
    {
        return array_map(
            function ($path) {
                return base_path($path);
            },
            $this->config->get('streams::addons.eager', [])
        );
    }

    /**
     * Return paths to deferred addons.
     *
     * @return array
     */
    protected function deferred()
    {
        return array_map(
            function ($path) {
                return base_path($path);
            },
            $this->config->get('streams::addons.deferred', [])
        );
    }

    /**
     * Return all native addon paths.
     *
     * @return bool
     */
    public function native()
    {
        $path = base_path('vendor');

        if (!is_dir($path)) {
            return false;
        }
        
        $paths = [];

        foreach (config('streams::addons.types') as $type) {
            $paths = array_merge($paths, glob("{$path}/*/*-{$type}", GLOB_ONLYDIR));
        }
        
        return $paths;
    }
    
    /**
     * Return all core addon paths in a given folder.
     *
     * @return bool
     */
    public function core()
    {
        $path = base_path('core');

        if (!is_dir($path)) {
            return false;
        }

        return $this->vendorAddons(glob("{$path}/*", GLOB_ONLYDIR));
    }

    /**
     * Return vendor addons of a given type.
     *
     * @param $directories
     * @return array
     */
    protected function vendorAddons($directories)
    {
        $paths = [];

        foreach ($directories as $vendor) {
            foreach (glob("{$vendor}/*", GLOB_ONLYDIR) as $addon) {
                $paths[] = $addon;
            }
        }

        return $paths;
    }

    /**
     * Return all shared addon paths in a given folder.
     *
     * @return bool
     */
    public function shared()
    {
        $path = base_path('addons/shared');

        if (!is_dir($path)) {
            return false;
        }

        return $this->vendorAddons(glob("{$path}/*", GLOB_ONLYDIR));
    }

    /**
     * Return all application addon paths in a given folder.
     *
     * @return bool
     */
    public function application()
    {
        $path = base_path('addons/' . $this->application->getReference());

        if (!is_dir($path)) {
            return false;
        }

        return $this->vendorAddons(glob("{$path}/*", GLOB_ONLYDIR));
    }

    /**
     * Return paths to testing only addons.
     *
     * @return array|bool
     */
    public function testing()
    {
        $path = base_path('vendor/visiosoft/streams-platform/addons');

        if (env('APP_ENV') !== 'testing') {
            return false;
        }

        return $this->vendorAddons(glob("{$path}/*", GLOB_ONLYDIR));
    }

    /**
     * Return paths to testing only addons.
     *
     * @return array|bool
     */
    protected function directory($directory)
    {
        $path = base_path($directory);

        if (!is_dir($path)) {
            return false;
        }

        return $this->vendorAddons(glob("{$path}/*", GLOB_ONLYDIR));
    }

    /**
     * Return paths to configured addons.
     *
     * @return array|bool
     */
    protected function configured()
    {
        $paths = array_map(
            function ($path) {
                return base_path($path);
            },
            $this->config->get('streams::addons.paths', [])
        );

        foreach ($this->config->get('streams::addons.directories', []) as $directory) {
            $paths = array_merge($paths, (array)$this->directory(trim($directory, '\\/')));
        }

        return array_unique(array_filter($paths));
    }
}
