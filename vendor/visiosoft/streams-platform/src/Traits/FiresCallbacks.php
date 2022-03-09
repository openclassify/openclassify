<?php namespace Anomaly\Streams\Platform\Traits;

/**
 * Class FiresCallbacks
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
trait FiresCallbacks
{

    /**
     * The local callbacks.
     *
     * @var array
     */
    protected $callbacks = [];

    /**
     * The static callbacks.
     *
     * @var array
     */
    protected static $listeners = [];

    /**
     * Register a new callback.
     *
     * @param $trigger
     * @param $callback
     * @return $this
     */
    public function on($trigger, $callback)
    {
        if (!isset($this->callbacks[$trigger])) {
            $this->callbacks[$trigger] = [];
        }

        $this->callbacks[$trigger][] = $callback;

        return $this;
    }

    /**
     * Register a new listener.
     *
     * @param $trigger
     * @param $callback
     * @return $this
     */
    public static function when($trigger, $callback)
    {
        $trigger = static::class . '::' . $trigger;

        if ( ! isset(self::$listeners[ $trigger ])) {
            self::$listeners[ $trigger ] = [];
        }

        self::$listeners[ $trigger ][] = $callback;
    }

    /**
     * Register a new listener.
     *
     * @param $trigger
     * @param $callback
     * @return $this
     */
    public function listen($trigger, $callback)
    {
        $trigger = get_class($this) . '::' . $trigger;

        if (!isset(self::$listeners[$trigger])) {
            self::$listeners[$trigger] = [];
        }

        self::$listeners[$trigger][] = $callback;

        return $this;
    }

    /**
     * Fire a set of closures by trigger.
     *
     * @param        $trigger
     * @param  array $parameters
     * @return $this
     */
    public function fire($trigger, array $parameters = [])
    {

        /*
         * First, fire global listeners.
         */
        $classes = array_merge(class_parents($this), [get_class($this) => get_class($this)]);

        foreach (array_keys($classes) as $caller) {

            foreach (array_get(self::$listeners, $caller . '::' . $trigger, []) as $callback) {

                if (is_string($callback) || $callback instanceof \Closure) {
                    app()->call($callback, $parameters);
                }

                if (method_exists($callback, 'handle')) {
                    app()->call([$callback, 'handle'], $parameters);
                }
            }
        }

        /*
         * Next, check if the method
         * exists and run it if it does.
         */
        $method = camel_case('on_' . $trigger);

        if (method_exists($this, $method)) {
            app()->call([$this, $method], $parameters);
        }

        /*
         * Finally, run through all of
         * the registered callbacks.
         */
        foreach (array_get($this->callbacks, $trigger, []) as $callback) {

            if (is_string($callback) || $callback instanceof \Closure) {
                app()->call($callback, $parameters);
            }

            if (method_exists($callback, 'handle')) {
                app()->call([$callback, 'handle'], $parameters);
            }
        }

        return $this;
    }

    /**
     * Return if the callback exists.
     *
     * @param $trigger
     * @return bool
     */
    public function hasCallback($trigger)
    {
        return isset($this->callbacks[$trigger]);
    }

    /**
     * Return if the listener exists.
     *
     * @param $trigger
     * @return bool
     */
    public function hasListener($trigger)
    {
        return isset(self::$listeners[get_class($this) . '::' . $trigger]);
    }
}
