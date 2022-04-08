<?php namespace Anomaly\Streams\Platform\Support;

use Exception;
use Illuminate\Support\HigherOrderCollectionProxy;

/**
 * Class Collection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Collection extends \Illuminate\Support\Collection
{

    /**
     * @return $this
     */
    public function shouldBeSearchable()
    {
        return $this;
    }

    /**
     * Pad to the specified size with a value.
     *
     * @param        $size
     * @param  null  $value
     * @return $this
     */
    public function pad($size, $value = null)
    {
        if ($this->isEmpty()) {
            return $this;
        }

        return new static(array_pad($this->items, $size, $value));
    }

    /**
     * An alias for slice.
     *
     * @param $offset
     * @return $this
     */
    public function skip($offset)
    {
        return $this->slice($offset, null, true);
    }

    /**
     * Return undecorated items.
     *
     * @return static|$this
     */
    public function undecorate()
    {
        return new static((new Decorator())->undecorate($this->items));
    }

    /**
     * Map to get.
     *
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {

        if (in_array($name, static::$proxies)) {
            return new HigherOrderCollectionProxy($this, $name);
        }

        if ($this->has($name)) {
            return $this->get($name);
        }

        return call_user_func([$this, camel_case($name)]);
    }

    /**
     * Map to get.
     *
     * @param string $method
     * @param array  $parameters
     */
    public function __call($method, $parameters)
    {
        return $this->get($method);
    }
}
