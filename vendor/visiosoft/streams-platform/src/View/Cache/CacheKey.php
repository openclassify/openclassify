<?php namespace Anomaly\Streams\Platform\View\Cache;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Support\Presenter;
use Asm89\Twig\CacheExtension\CacheStrategy\KeyGeneratorInterface;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * Class CacheKey
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CacheKey implements KeyGeneratorInterface
{

    /**
     * Generate a cache key for a given value.
     *
     * @param mixed $value
     *
     * @return string
     */
    public function generateKey($value)
    {
        if ($value instanceof Paginator) {
            $value = $value->items();
        }

        if ($value instanceof Collection) {
            return implode(
                '_',
                $value->map(
                    function ($item) {
                        return $this->generateKey($item);
                    }
                )->all()
            );
        }

        if ($value instanceof Presenter) {
            $value = $value->getObject();
        }

        if ($value instanceof EntryInterface) {
            return get_class($value) . $value->getId() . $value->lastModified();
        }

        if ($value instanceof Arrayable) {
            $value = $value->toArray();
        }

        if (is_array($value)) {
            return 'array_' . md5(
                    json_encode(
                        array_map(
                            function ($value) {
                                return $this->generateKey($value);
                            },
                            $value
                        )
                    )
                );
        }

        return $value;
    }
}
