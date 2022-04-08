<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Item;

use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Ui\Tree\Component\Item\Contract\ItemInterface;

/**
 * Class ItemCollection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ItemCollection extends Collection
{

    /**
     * Return only root items.
     *
     * @return ItemCollection
     */
    public function root()
    {
        $root = [];

        /* @var ItemInterface $item */
        foreach ($this->items as $item) {
            if (!$item->getParent()) {
                $root[] = $item;
            }
        }

        return new static($root);
    }

    /**
     * Return only children of the provided item.
     *
     * @param  ItemInterface  $parent
     * @return ItemCollection
     */
    public function children(ItemInterface $parent)
    {
        $children = [];

        /* @var ItemInterface $item */
        foreach ($this->items as $item) {
            if ($item->getParent() == $parent->getId()) {
                $children[] = $item;
            }
        }

        return new static($children);
    }
}
