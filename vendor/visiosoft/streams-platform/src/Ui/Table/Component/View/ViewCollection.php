<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View;

use Anomaly\Streams\Platform\Ui\Table\Component\View\Contract\ViewInterface;
use Illuminate\Support\Collection;

/**
 * Class ViewCollection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ViewCollection extends Collection
{

    /**
     * Return the active view or null.
     *
     * @return null|ViewInterface
     */
    public function active()
    {
        /* @var ViewInterface $item */
        foreach ($this->items as $item) {
            if ($item->isActive()) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Find a view by it's slug.
     *
     * @param $slug
     * @return null|ViewInterface
     */
    public function findBySlug($slug)
    {
        /* @var ViewInterface $item */
        foreach ($this->items as $item) {
            if ($item->getSlug() == $slug) {
                return $item;
            }
        }

        return null;
    }
}
