<?php namespace Anomaly\Streams\Platform\Collection;

use Illuminate\Support\Collection;

/**
 * Class CacheCollection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CacheCollection extends Collection
{

    /**
     * The collection key.
     *
     * @var null
     */
    protected $key = null;

    /**
     * Create a new CacheCollection instance.
     *
     * @param array $items
     * @param null $key
     */
    public function __construct(array $items = [], $key = null)
    {
        $this->key   = $key;
        $this->items = $items;
    }

    /**
     * Flush the cache collection.
     *
     * @return $this
     */
    public function flush()
    {
        $this->index();

        foreach ($this->items as $key) {
            cache()->forget($key);
        }

        cache()->forget($this->key);

        $this->items = [];

        return $this;
    }

    /**
     * Index the collection.
     *
     * @return $this
     */
    public function index()
    {
        if ($keys = cache($this->key, [])) {
            $this->addKeys($keys);
        }

        $this->unique();

        $self = $this;

        sort($keys);
        sort($this->items);

        if ($keys == $this->items) {
            return $this;
        }

        cache()->forget($this->key);

        cache()->rememberForever(
            $this->key,
            function () use ($self) {
                return $self->all();
            }
        );

        return $this;
    }

    /**
     * Add cached keys.
     *
     * @param  array $keys
     * @return $this
     */
    public function addKeys(array $keys = [])
    {
        foreach ($keys as $key) {
            $this->push($key);
        }

        return $this;
    }

    /**
     * Return only unique items from the collection array.
     *
     * @param null $key
     * @param bool $strict
     */
    public function unique($key = null, $strict = false)
    {
        $this->items = array_unique($this->items);

        return $this;
    }

    /**
     * Store a key and return it.
     *
     * @param $key
     * @return mixed
     */
    public function key($key)
    {
        $this->push($key);

        $this->index();

        return $key;
    }

    /**
     * Get the collection key.
     *
     * @return null
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set the collection key.
     *
     * @param  null $key
     * @return $this
     */
    public function setKey($key = null)
    {
        $this->key = $key;

        return $this;
    }
}
