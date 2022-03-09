<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class LinkCollection
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LinkCollection extends EntryCollection
{

    /**
     * Alias for $this->top()
     *
     * @return LinkCollection
     */
    public function root()
    {
        return $this->top();
    }

    /**
     * Return only top level links.
     *
     * @return LinkCollection
     */
    public function top()
    {
        return $this->filter(
            function ($item) {

                /* @var LinkInterface $item */
                return !$item->getParentId();
            }
        );
    }

    /**
     * Return only enabled links.
     *
     * @return LinkCollection
     */
    public function enabled()
    {
        return $this->filter(
            function ($item) {

                /* @var LinkInterface $item */
                return $item->isEnabled();
            }
        );
    }

    /**
     * Return only children of the provided item.
     *
     * @param $parent
     * @return LinkCollection|null
     */
    public function children($parent)
    {
        if (!$parent) {
            return null;
        }

        /* @var LinkInterface $parent */
        return $this->filter(
            function ($item) use ($parent) {

                /* @var LinkInterface $item */
                return $item->getParentId() == $parent->getId();
            }
        );
    }

    /**
     * Return the current link.
     *
     * @return LinkInterface|null
     */
    public function current()
    {
        /* @var LinkInterface $item */
        foreach ($this->items as $item) {

            if ($item->isCurrent()) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Return the current link's children.
     *
     * @param null|LinkInterface $link
     * @return LinkCollection|null
     */
    public function siblings($link = null)
    {
        if (!$link) {
            $link = $this->current();
        }

        if (!$link) {
            return null;
        }

        if (!$parent = $link->getParent()) {
            return $this->root();
        }

        return $this->children($parent);
    }

    /**
     * Return only active links.
     *
     * @param  bool $active
     * @return LinkCollection
     */
    public function active($active = true)
    {
        return $this->filter(
            function ($item) use ($active) {

                /* @var LinkInterface $item */
                return $item->isActive() == $active;
            }
        );
    }
}
