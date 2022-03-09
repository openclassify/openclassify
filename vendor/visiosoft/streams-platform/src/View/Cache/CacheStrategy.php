<?php namespace Anomaly\Streams\Platform\View\Cache;

use Asm89\Twig\CacheExtension\CacheProviderInterface;
use Asm89\Twig\CacheExtension\CacheStrategy\KeyGeneratorInterface;
use Asm89\Twig\CacheExtension\CacheStrategyInterface;

/**
 * Class CacheStrategy
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CacheStrategy implements CacheStrategyInterface
{

    /**
     * The cache provider.
     *
     * @var CacheProviderInterface
     */
    private $cache;

    /**
     * The key generator.
     *
     * @var KeyGeneratorInterface
     */
    private $generator;

    /**
     * The default lifetime.
     *
     * @var int
     */
    private $lifetime;

    /**
     * Create a new CacheStrategy instance.
     *
     * @param CacheProviderInterface $cache
     * @param KeyGeneratorInterface  $generator
     * @param integer                $lifetime
     */
    public function __construct(CacheProviderInterface $cache, KeyGeneratorInterface $generator, $lifetime = 0)
    {
        $this->cache     = $cache;
        $this->generator = $generator;
        $this->lifetime  = $lifetime;
    }

    /**
     * Fetch the block for a given key.
     *
     * @param mixed $key
     *
     * @return string
     */
    public function fetchBlock($key)
    {
        if (is_array($key)) {
            $key = $key['key'];
        }

        return $this->cache->fetch($key);
    }

    /**
     * Generate a key for the value.
     *
     * @param string $annotation
     * @param mixed  $value
     *
     * @return mixed
     */
    public function generateKey($annotation, $value)
    {
        if (is_numeric($value)) {
            return [
                'lifetime' => $value,
                'key'      => $annotation,
            ];
        }

        $key = $this->generator->generateKey($value);

        if ($key === null) {
            throw new \RuntimeException('You must provide a cache key.');
        }

        return $annotation . $key;
    }

    /**
     * Save the contents of a rendered block.
     *
     * @param mixed  $key
     * @param string $block
     */
    public function saveBlock($key, $block)
    {
        if (is_array($key)) {
            $lifetime = $key['lifetime'];
            $key      = $key['key'];
        } else {
            $lifetime = $this->lifetime;
        }

        return $this->cache->save($key, $block, $lifetime);
    }
}
