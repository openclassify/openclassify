<?php namespace Anomaly\Streams\Platform\Traits;

/**
 * Class Hookable
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
trait Hookable
{

    /**
     * The registered hooks.
     *
     * @var array
     */
    protected static $hooks = [];

    /**
     * Register a new hook.
     *
     * @param        $hook
     * @param        $callback
     * @param  bool  $bind
     * @return $this
     */
    public function hook($hook, $callback, $bind = false)
    {
        $owner = get_class($this);

        self::$hooks[$hook][] = compact('owner', 'callback', 'bind');

        return $this;
    }

    /**
     * Bind a new hook. This is a shortcut
     * for hooks with the bind option. It's
     * more descriptive for IDE hinting.
     *
     * @param $hook
     * @param $callback
     * @return $this
     */
    public function bind($hook, $callback)
    {
        return $this->hook($hook, $callback, true);
    }

    /**
     * Call a hook.
     *
     * @param        $hook
     * @param  array $parameters
     * @return mixed
     */
    public function call($hook, array $parameters = [])
    {

        /*
         * Check if the method exists
         * first and run it if it does.
         */
        if (method_exists($this, $method = camel_case($hook))) {
            return app()->call([$this, $method], $parameters);
        }

        /**
         * Get the registered hook otherwise.
         */
        if (!$hook = $this->getHook($hook)) {
            throw new \Exception('The hook [' . $hook . '] does not exist for [' . get_class($this) . '].');
        }

        /**
         * Setup the closure to call.
         */
        if ($hook['bind']) {
            $hook['callback'] = \Closure::bind($hook['callback'], $this, get_class());
        }

        return app()->call($hook['callback'], $parameters);
    }

    /**
     * Return if the hook exists.
     *
     * @param $hook
     * @return bool
     */
    public function hasHook($hook)
    {
        return $this->getHook($hook) !== null;
    }

    /**
     * Get a hook.
     *
     * @param $hook
     * @return bool
     */
    public function getHook($hook)
    {
        if (!isset(self::$hooks[$hook])) {
            return null;
        }

        foreach (self::$hooks[$hook] as $hook) {
            if ($this instanceof $hook['owner']) {
                return $hook;
            }
        }

        return null;
    }

    /**
     * Register a new hook.
     *
     * @param        $hook
     * @param        $callback
     * @param  bool  $bind
     */
    public static function _hook($hook, $callback, $bind = false)
    {
        $owner = __CLASS__;

        self::$hooks[$hook][] = compact('owner', 'callback', 'bind');
    }

    /**
     * Bind a new hook. This is a shortcut
     * for hooks with the bind option. It's
     * more descriptive for IDE hinting.
     *
     * @param $hook
     * @param $callback
     */
    public static function _bind($hook, $callback)
    {
        self::_hook($hook, $callback, true);
    }
}
