<?php namespace Anomaly\Streams\Platform\View\Cache;

use Asm89\Twig\CacheExtension\CacheProviderInterface;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Cache\Store;

/**
 * Class CacheAdapter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CacheAdapter implements CacheProviderInterface
{

    /**
     * The cache repository.
     *
     * @var Repository
     */
    protected $cache;

    /**
     * Create a new cache adapter.
     *
     * @param Repository $cache
     */
    public function __construct(Repository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * Get the cached value.
     *
     * @param  string $key
     * @return mixed
     */
    public function fetch($key)
    {
        // @todo: Replace ENV usage with view.php configuration in streams.
        // Caching config will break this.
        return $this->cache->get(env('TWIG_CACHE', true) ? $key : null, false);
    }

    /**
     * Put the cached value.
     *
     * @param string $key
     * @param string $value
     * @param int    $lifetime
     */
    public function save($key, $value, $lifetime = 0)
    {
        if (env('TWIG_CACHE', true)) {
            $this->cache->put($key, $value, $lifetime);
        }
    }
}
