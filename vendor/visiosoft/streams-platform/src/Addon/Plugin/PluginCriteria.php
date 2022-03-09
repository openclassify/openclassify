<?php namespace Anomaly\Streams\Platform\Addon\Plugin;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Support\Collection;
use Closure;

/**
 * Class PluginCriteria
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PluginCriteria
{

    /**
     * The model name.
     *
     * @var null|string|EloquentModel
     */
    protected $model = null;

    /**
     * The cache prefix.
     *
     * @var null|string
     */
    protected $cachePrefix = null;

    /**
     * The options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The options collection.
     *
     * @var Collection
     */
    protected $collection = Collection::class;

    /**
     * The callback trigger.
     *
     * @var string
     */
    protected $trigger;

    /**
     * The resolving callback.
     *
     * @var Closure
     */
    protected $callback;

    /**
     * Create a new PluginCriteria instance.
     *
     * @param         $trigger
     * @param Closure $callback
     */
    public function __construct($trigger, Closure $callback)
    {
        $this->trigger  = $trigger;
        $this->callback = $callback;
    }

    /**
     * Set the cache parameters.
     *
     * @param null $parameters
     * @return $this
     */
    public function cache($parameters = null)
    {
        if (is_numeric($parameters)) {
            $parameters = [
                'ttl' => $parameters,
            ];
        }

        if (is_string($parameters)) {
            $parameters = [
                'namespace' => $parameters,
            ];
        }

        $this->options['cache'] = $parameters;

        return $this;
    }

    /**
     * Return an option value.
     *
     * @param        $key
     * @param  null $default
     * @return mixed
     */
    public function option($key, $default = null)
    {
        return array_get($this->options, $key, $default);
    }

    /**
     * Get the options.
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set the options.
     *
     * @param array $options
     */
    public function setOptions(array $options = [])
    {
        $this->options = $options;
    }

    /**
     * Get the collection.
     *
     * @return string
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Set the collection.
     *
     * @param $collection
     * @return $this
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * Return a new collection.
     *
     * @return Collection
     */
    public function newCollection()
    {
        $collection = $this->getCollection();

        return new $collection($this->getOptions());
    }

    /**
     * Get the model.
     *
     * @return null|EloquentModel
     */
    public function getModel()
    {
        if ($this->model && !is_object($this->model)) {
            $this->model = app($this->model);
        }

        return $this->model;
    }

    /**
     * Set the model.
     *
     * @param $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Get the cache key.
     *
     * @return null|string
     */
    public function getCacheKey()
    {
        $key = array_get(
            $this->options,
            'cache.key',
            $this->getCachePrefix() . '.'
            . md5(json_encode($this->collection)) . '.'
            . md5(json_encode($this->options))
        );

        $namespace = array_get($this->options, 'cache.namespace');

        if ($namespace == 'user') {
            $key .= auth()->id();
        }

        if ($namespace == 'session') {
            $key .= session()->getId();
        }

        return $key;
    }

    /**
     * Get the cache prefix.
     *
     * @return null|string
     */
    public function getCachePrefix()
    {
        if ($model = $this->getModel()) {
            return $this->cachePrefix;
        }
    }

    /**
     * Set the cache prefix.
     *
     * @param $cachePrefix
     * @return $this
     */
    public function setCachePrefix($cachePrefix)
    {
        $this->cachePrefix = $cachePrefix;

        return $this;
    }

    /**
     * Get the cache TTL.
     *
     * @return null|int
     */
    public function getCacheTtl()
    {
        return array_get($this->collection, 'ttl', 60 * 24 * 7);
    }

    /**
     * Set the cache ttl.
     *
     * @param $cacheTtl
     * @return $this
     */
    public function setCacheTtl($cacheTtl)
    {
        $this->cacheTtl = $cacheTtl;

        return $this;
    }

    /**
     * Route through __call
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->__call($name, []);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed|$this
     */
    public function __call($name, $arguments)
    {
        if ($name == $this->trigger) {
            return $this->__fire();
        }

        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }

        if (count($arguments) == 1) {
            array_set($this->options, snake_case($name), array_shift($arguments));
        } else {
            array_set($this->options, snake_case($name), $arguments);
        }

        return $this;
    }

    /**
     * Return the plugin result.
     *
     * @return mixed
     */
    protected function __fire()
    {
        $collection = $this->newCollection();

        if ($collection->has('cache')) {

            $callback = function () use ($collection) {
                return app()->call(
                    $this->callback,
                    [
                        'options'  => $collection,
                        'criteria' => $this,
                    ]
                );
            };

            if ($model = $this->getModel()) {
                return $model->cache(
                    $this->getCacheKey(),
                    $this->getCacheTtl(),
                    $callback
                );
            }

            return cache()->remember(
                $this->getCacheKey(),
                $this->getCacheTtl(),
                $callback
            );
        }

        return app()->call(
            $this->callback,
            [
                'options'  => $collection,
                'criteria' => $this,
            ]
        );
    }

    /**
     * Trigger on toString.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->{$this->trigger};
    }
}
