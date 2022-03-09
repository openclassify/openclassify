<?php namespace Anomaly\Streams\Platform\Lang;

use Anomaly\Streams\Platform\Addon\Addon;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Application\Application;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;

/**
 * Class Loader
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Loader extends FileLoader
{

    /**
     * The runtime cache.
     *
     * @var array
     */
    protected static $disabled = [];

    /**
     * The streams path.
     *
     * @var string
     */
    protected $streams;

    /**
     * The addon collection instance.
     *
     * @var AddonCollection
     */
    protected $addons;

    /**
     * The application instance.
     *
     * @var Application
     */
    protected $application;

    /**
     * Create a new Loader instance.
     *
     * @param Filesystem $files
     * @param string $path
     */
    public function __construct(Filesystem $files, $path)
    {
        $this->streams = base_path('vendor/visiosoft/streams-platform/resources/lang');

        $this->application = app(Application::class);
        $this->addons      = app(AddonCollection::class);

        parent::__construct($files, $path);
    }

    /**
     * Load a locale from a given path.
     *
     * Keep streams overrides in place
     * that are NOT namespaced cause
     * we're overriding Laravel's
     * base language files too.
     *
     * @param string $path
     * @param string $locale
     * @param string $group
     * @return array
     */
    protected function loadPath($path, $locale, $group)
    {
        $lines = parent::loadPath($path, $locale, $group);

        if ($path == $this->streams && $lines) {
            $lines = $this->loadAddonOverrides($lines, $locale, $group);
            $lines = $this->loadSystemOverrides($lines, $locale, $group);
            $lines = $this->loadApplicationOverrides($lines, $locale, $group);
        }

        return $lines;
    }

    /**
     * Load namespaced overrides from
     * system AND application paths.
     *
     * @param  array $lines
     * @param  string $locale
     * @param  string $group
     * @param  string $namespace
     * @return array
     */
    protected function loadNamespaceOverrides(array $lines, $locale, $group, $namespace)
    {
        /**
         * @deprecated since 1.6; Use manual loading or publishing.
         */
        if (env('AUTOMATIC_ADDON_OVERRIDES', true)) {
            $lines = $this->loadAddonOverrides($lines, $locale, $group, $namespace);
        }

        $lines = $this->loadSystemOverrides($lines, $locale, $group, $namespace);
        $lines = $this->loadApplicationOverrides($lines, $locale, $group, $namespace);

        return parent::loadNamespaceOverrides($lines, $locale, $group, $namespace);
    }

    /**
     * Load system overrides.
     *
     * @param  array $lines
     * @param        $locale
     * @param        $group
     * @param        $namespace
     * @return array
     */
    protected function loadSystemOverrides(array $lines, $locale, $group, $namespace = null)
    {
        if (!$namespace || $namespace == 'streams') {

            $file = base_path("resources/streams/lang/{$locale}/{$group}.php");

            if (is_dir(base_path("resources/streams/lang")) && $this->files->exists($file)) {
                $lines = array_replace_recursive($lines, $this->files->getRequire($file));
            }
        }

        if (str_is('*.*.*', $namespace)) {

            list($vendor, $type, $slug) = explode('.', $namespace);

            $file = base_path("resources/addons/{$vendor}/{$slug}-{$type}/lang/{$locale}/{$group}.php");

            if (is_dir(base_path("resources/addons/{$vendor}/{$slug}-{$type}/lang")) && $this->files->exists($file)) {
                $lines = array_replace_recursive($lines, $this->files->getRequire($file));
            }
        }

        return $lines;
    }

    /**
     * Load system overrides.
     *
     * @param  array $lines
     * @param        $locale
     * @param        $group
     * @param        $namespace
     * @return array
     */
    protected function loadApplicationOverrides(array $lines, $locale, $group, $namespace = null)
    {
        if (!$namespace || $namespace == 'streams') {

            $file = $this->application->getResourcesPath("streams/lang/{$locale}/{$group}.php");

            if (is_dir($this->application->getResourcesPath("streams/lang")) && $this->files->exists($file)) {
                $lines = array_replace_recursive($lines, $this->files->getRequire($file));
            }
        }

        if (str_is('*.*.*', $namespace)) {

            list($vendor, $type, $slug) = explode('.', $namespace);

            $file = $this->application->getResourcesPath(
                "addons/{$vendor}/{$slug}-{$type}/lang/{$locale}/{$group}.php"
            );

            if (
                is_dir($this->application->getResourcesPath("addons/{$vendor}/{$slug}-{$type}/lang"))
                && $this->files->exists($file)
            ) {
                $lines = array_replace_recursive($lines, $this->files->getRequire($file));
            }
        }

        return $lines;
    }

    /**
     * @param array $lines
     * @param       $locale
     * @param       $group
     * @param null $namespace
     * @return array
     */
    protected function loadAddonOverrides(array $lines, $locale, $group, $namespace = null)
    {
        /** @var Addon $addon */
        foreach ($this->addons->enabled() as $addon) {

            $disabled = array_get(self::$disabled, $key = $addon->getNamespace('streams'), false);

            if (!$disabled && !$this->files->isDirectory($addon->getPath('resources/streams'))) {
                self::$disabled[$key] = $disabled = true;
            }

            if (!$disabled && (!$namespace || $namespace == 'streams')) {

                $file = $addon->getPath("resources/streams/lang/{$locale}/{$group}.php");

                if ($this->files->exists($file)) {
                    $lines = array_replace_recursive($lines, $this->files->getRequire($file));
                }
            }

            $disabled = array_get(self::$disabled, $key = $addon->getNamespace('addons'), false);

            if (!$disabled && !$this->files->isDirectory($addon->getPath('resources/addons'))) {
                self::$disabled[$key] = $disabled = true;
            }

            if (!$disabled && str_is('*.*.*', $namespace)) {

                list($vendor, $type, $slug) = explode('.', $namespace);

                $file = $addon->getPath(
                    "resources/addons/{$vendor}/{$slug}-{$type}/lang/{$locale}/{$group}.php"
                );

                if ($this->files->exists($file)) {
                    $lines = array_replace_recursive($lines, $this->files->getRequire($file));
                }
            }
        }

        return $lines;
    }
}
