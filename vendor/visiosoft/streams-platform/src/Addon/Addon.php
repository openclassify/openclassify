<?php namespace Anomaly\Streams\Platform\Addon;

use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Anomaly\Streams\Platform\Traits\Hookable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Robbo\Presenter\PresentableInterface;
use Robbo\Presenter\Presenter;

/**
 * Class Addon
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Addon implements PresentableInterface, Arrayable
{

    use Hookable;
    use FiresCallbacks;
    use DispatchesJobs;

    /**
     * Static shared cache.
     *
     * @var array
     */
    protected static $_cache = [];

    /**
     * Runtime cache.
     *
     * @var array
     */
    protected $cache = [];

    /**
     * The addon path.
     *
     * @var string
     */
    protected $path = null;

    /**
     * The addon type.
     *
     * @var string
     */
    protected $type = null;

    /**
     * The addon slug.
     *
     * @var string
     */
    protected $slug = null;

    /**
     * Get the name.
     *
     * @var null|string
     */
    protected $name = null;

    /**
     * Get the title.
     *
     * @var null|string
     */
    protected $title = null;

    /**
     * Get the title.
     *
     * @var null|string
     */
    protected $description = null;

    /**
     * The sub-addons to load.
     *
     * @var array
     */
    protected $addons = [];

    /**
     * The addon vendor.
     *
     * @var string
     */
    protected $vendor = null;

    /**
     * The addon namespace.
     *
     * @var null|string
     */
    protected $namespace = null;

    /**
     * Get the addon's presenter.
     *
     * @return Presenter
     */
    public function getPresenter()
    {
        return app()->make(AddonPresenter::class, ['object' => $this]);
    }

    /**
     * Return a new service provider.
     *
     * @return AddonServiceProvider
     */
    public function newServiceProvider()
    {
        return app()->make(
            $this->getServiceProvider(),
            [
                'container' => app(),
                'addon'     => $this,
            ]
        );
    }

    /**
     * Get the service provider class.
     *
     * @return string
     */
    public function getServiceProvider()
    {
        return get_class($this) . 'ServiceProvider';
    }

    /**
     * Return whether the addon is core or not.
     *
     * @return bool
     */
    public function isCore()
    {
        return str_contains($this->getPath(), 'core/' . $this->getVendor());
    }

    /**
     * Return whether the addon is shared or not.
     *
     * @return bool
     */
    public function isShared()
    {
        return str_contains($this->getPath(), 'addons/shared/' . $this->getVendor());
    }

    /**
     * Return whether the addon is for testing or not.
     *
     * @return bool
     */
    public function isTesting()
    {
        return str_contains($this->getPath(), 'vendor/visiosoft/streams-platform/addons/' . $this->getVendor());
    }

    /**
     * Set the name.
     *
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the addon name string.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name ?: $this->getNamespace('addon.name');
    }

    /**
     * Set the title.
     *
     * @param $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the addon title string.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title ?: (trans()->has($this->getNamespace('addon.title')) ? $this->getNamespace(
            'addon.title'
        ) : $this->getName());
    }

    /**
     * Set the description.
     *
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the addon description string.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description ?: $this->getNamespace('addon.description');
    }

    /**
     * Get a namespaced key string.
     *
     * @param  null $key
     * @return string
     */
    public function getNamespace($key = null)
    {
        if (!$this->namespace) {
            $this->makeNamespace();
        }

        return $this->namespace . ($key ? '::' . $key : $key);
    }

    /**
     * Get the transformed
     * class to another suffix.
     *
     * @param  null $suffix
     * @return string
     */
    public function getTransformedClass($suffix = null)
    {
        $namespace = implode('\\', array_slice(explode('\\', get_class($this)), 0, -1));

        return $namespace . ($suffix ? '\\' . $suffix : $suffix);
    }

    /**
     * Return the ID representation (namespace).
     *
     * @return string
     */
    public function getId()
    {
        return $this->getNamespace();
    }

    /**
     * Return whether an addon has
     * config matching the key.
     *
     * @param  string $key
     * @return boolean
     */
    public function hasConfig($key = '*')
    {
        return (bool)config($this->getNamespace($key));
    }

    /**
     * Return whether an addon has
     * config matching any key.
     *
     * @param  array $keys
     * @return bool
     */
    public function hasAnyConfig(array $keys = ['*'])
    {
        foreach ($keys as $key) {
            if ($this->hasConfig($key)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the composer json contents.
     *
     * @return mixed|null
     */
    public function getComposerJson()
    {
        $key = $this->getNamespace() . '::' . __FUNCTION__;

        if (isset(self::$_cache[$key])) {
            return self::$_cache[$key];
        }

        $composer = $this->getPath('composer.json');

        if (!file_exists($composer)) {
            return self::$_cache[$key] = null;
        }

        if (!$json = array_get(self::$_cache, $key)) {
            return self::$_cache[$key] = json_decode(file_get_contents($composer), true);
        }

        return $json;
    }

    /**
     * Get the composer json contents.
     *
     * @return array|null
     */
    public function getComposerLock()
    {
        $key = $this->getNamespace() . '::' . __FUNCTION__;

        if (isset(self::$_cache[$key])) {
            return self::$_cache[$key];
        }

        $lock = base_path('composer.lock');

        if (!file_exists($lock)) {
            return self::$_cache[$key] = null;
        }

        if (!$json = array_get(self::$_cache, 'composer.lock')) {
            $json = self::$_cache['composer.lock'] = json_decode(file_get_contents($lock), true);
        }

        return self::$_cache[$key] = array_first(
            $json['packages'],
            function (array $package) {
                return $package['name'] == $this->getPackageName();
            }
        );
    }

    /**
     * Get the README.md contents.
     *
     * @return string|null
     */
    public function getReadme()
    {
        $readme = $this->getPath('README.md');

        if (file_exists($readme)) {
            return file_get_contents($readme);
        }

        return null;
    }

    /**
     * Return the package name.
     *
     * @return string
     */
    public function getPackageName()
    {
        return $this->getVendor() . '/' . $this->getSlug() . '-' . $this->getType();
    }

    /**
     * Sets the path.
     *
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the addon path.
     *
     * @return string
     */
    public function getPath($path = null)
    {
        return $this->path . ($path ? '/' . $path : $path);
    }

    /**
     * Return the app path.
     *
     * @param null $path
     */
    public function getAppPath($path = null)
    {
        return ltrim(str_replace(base_path(), '', $this->getPath($path)), DIRECTORY_SEPARATOR);
    }

    /**
     * Set the addon slug.
     *
     * @param  $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the addon slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the addon type.
     *
     * @param  $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the addon type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the vendor.
     *
     * @param $vendor
     * @return $this
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;

        return $this;
    }

    /**
     * Get the vendor.
     *
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * Get the sub-addons.
     *
     * @return array
     */
    public function getAddons()
    {
        return $this->addons;
    }

    /**
     * Set the loads
     *
     * @param $addons
     * @return $this
     */
    public function setAddons(array $addons)
    {
        $this->addons = $addons;

        return $this;
    }

    /**
     * Make the addon namespace.
     */
    protected function makeNamespace()
    {
        $this->namespace = "{$this->getVendor()}.{$this->getType()}.{$this->getSlug()}";
    }

    /**
     * Get a property value from the object.
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        $method = camel_case('get_' . $name);

        if (method_exists($this, $method)) {
            return $this->{$method}();
        }

        $method = camel_case('is_' . $name);

        if (method_exists($this, $method)) {
            return $this->{$method}();
        }

        return $this->{$name};
    }

    /**
     * Return whether a property is set or not.
     *
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        $method = camel_case('get_' . $name);

        if (method_exists($this, $method)) {
            return true;
        }

        $method = camel_case('is_' . $name);

        if (method_exists($this, $method)) {
            return true;
        }

        return isset($this->{$name});
    }

    /**
     * Return the addon as a string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getNamespace();
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'id'        => $this->getNamespace(),
            'name'      => $this->getName(),
            'namespace' => $this->getNamespace(),
            'type'      => $this->getType(),
        ];
    }
}
