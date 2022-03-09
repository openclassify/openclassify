<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Entry\EntryCollection;

/**
 * Class PageCollection
 *
 * @page          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PageCollection extends EntryCollection
{

    /**
     * Return only exact pages.
     *
     * @param  bool           $exact
     * @return PageCollection
     */
    public function exact($exact = true)
    {
        $enabled = $this->enabled();

        return $enabled->filter(
            function ($page) use ($exact) {

                /* @var PageInterface $page */
                return $page->isExact() == $exact;
            }
        );
    }

    /**
     * Return only enabled pages.
     *
     * @return PageCollection
     */
    public function enabled($enabled = true)
    {
        return self::make(
            array_filter(
                $this->items,
                function ($page) use ($enabled) {

                    /* @var PageInterface $page */
                    return $page->isEnabled() == $enabled;
                }
            )
        );
    }

    /**
     * Return only live pages.
     *
     * @return PageCollection
     */
    public function live($enabled = true)
    {
        return self::make(
            array_filter(
                $this->items,
                function ($page) use ($enabled) {

                    /* @var PageInterface $page */
                    return $page->isLive() == $enabled;
                }
            )
        );
    }

    /**
     * Return only visible pages.
     *
     * @param  bool           $visible
     * @return PageCollection
     */
    public function visible($visible = true)
    {
        $enabled = $this->enabled();

        return $enabled->filter(
            function ($page) use ($visible) {

                /* @var PageInterface $page */
                return $page->isVisible() == $visible;
            }
        );
    }

    /**
     * Alias for $this->top()
     *
     * @return PageCollection
     */
    public function root()
    {
        return $this->top();
    }

    /**
     * Return only top level pages.
     *
     * @return PageCollection
     */
    public function top()
    {
        return $this->filter(
            function ($item) {

                /* @var PageInterface $item */
                return !$item->getParentId();
            }
        );
    }

    /**
     * Return only children of the provided item.
     *
     * @param $parent
     * @return PageCollection
     */
    public function children($parent)
    {
        /* @var PageInterface $parent */
        return $this->filter(
            function ($item) use ($parent) {

                /* @var PageInterface $item */
                return $item->getParentId() == $parent->getId();
            }
        );
    }

    /**
     * Return the current page.
     *
     * @return PageInterface|null
     */
    public function current()
    {
        /* @var PageInterface $item */
        foreach ($this->items as $item) {

            if ($item->isCurrent()) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Return only active pages.
     *
     * @param  bool           $active
     * @return PageCollection
     */
    public function active($active = true)
    {
        return $this->filter(
            function ($item) use ($active) {

                /* @var PageInterface $item */
                return $item->isActive() == $active;
            }
        );
    }
}
