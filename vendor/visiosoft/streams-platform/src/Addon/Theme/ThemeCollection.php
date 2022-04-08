<?php namespace Anomaly\Streams\Platform\Addon\Theme;

use Anomaly\Streams\Platform\Addon\AddonCollection;

/**
 * Class ThemeCollection
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ThemeCollection extends AddonCollection
{

    /**
     * Return the active theme.
     *
     * @return Theme
     */
    public function active($type = null)
    {
        if (!$type) {
            return $this->current();
        }

        $admin = $type == 'standard' ? false : true;

        /* @var Theme $item */
        foreach ($this->items as $item) {
            if ($item->isActive() && $item->isAdmin() === $admin) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Return the current theme.
     *
     * @return null|Theme
     */
    public function current()
    {
        /* @var Theme $item */
        foreach ($this->items as $item) {
            if ($item->isCurrent()) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Return only non-admin themes.
     *
     * @return ThemeCollection
     */
    public function standard()
    {
        $items = [];

        /* @var Theme $item */
        foreach ($this->items as $item) {
            if (!$item->isAdmin()) {
                $items[] = $item;
            }
        }

        return new static($items);
    }

    /**
     * Return only admin themes.
     *
     * @return ThemeCollection
     */
    public function admin()
    {
        $items = [];

        /* @var Theme $item */
        foreach ($this->items as $item) {
            if ($item->isAdmin()) {
                $items[] = $item;
            }
        }

        return new static($items);
    }
}
