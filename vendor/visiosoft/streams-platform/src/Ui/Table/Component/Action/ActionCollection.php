<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\Contract\ActionInterface;
use Illuminate\Support\Collection;

/**
 * Class ActionCollection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ActionCollection extends Collection
{

    /**
     * Return the active action or null.
     *
     * @return null|ActionInterface
     */
    public function active()
    {
        foreach ($this->items as $item) {
            if ($item instanceof ActionInterface && $item->isActive()) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Find a action by it's slug.
     *
     * @param $slug
     * @return null|ActionInterface
     */
    public function findBySlug($slug)
    {
        foreach ($this->items as $item) {
            if ($item instanceof ActionInterface && $item->getSlug() == $slug) {
                return $item;
            }
        }

        return null;
    }
}
