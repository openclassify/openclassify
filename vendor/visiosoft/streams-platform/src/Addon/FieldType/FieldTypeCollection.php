<?php namespace Anomaly\Streams\Platform\Addon\FieldType;

use Anomaly\Streams\Platform\Addon\AddonCollection;

/**
 * Class FieldTypeCollection
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class FieldTypeCollection extends AddonCollection
{

    /**
     * Get a field type from the
     * collection by namespace key.
     *
     * @param  mixed $key
     * @param  mixed $default
     * @return null|FieldType
     */
    public function get($key, $default = null)
    {
        $type = parent::get($key, $default);

        if (!$type) {
            return null;
        }

        return clone($type);
    }

    /**
     * Find an addon by it's slug.
     *
     * @param  $slug
     *
     * @return null|FieldType
     */
    public function findBySlug($slug)
    {
        /* @var FieldType $item */
        foreach ($this->items as $item) {
            if ($item->getSlug() == $slug) {
                return clone($item);
            }
        }

        return null;
    }
}
