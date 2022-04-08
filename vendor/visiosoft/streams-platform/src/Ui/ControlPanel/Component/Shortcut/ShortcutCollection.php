<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut\Contract\ShortcutInterface;
use Illuminate\Support\Collection;

/**
 * Class ShortcutCollection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ShortcutCollection extends Collection
{

    /**
     * Return the active shortcut.
     *
     * @return null|ShortcutInterface
     */
    public function active()
    {
        /* @var ShortcutInterface $item */
        foreach ($this->items as $item) {
            if ($item->isActive()) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Return only root shortcuts.
     *
     * @return ShortcutCollection
     */
    public function root()
    {
        return self::make(
            array_filter(
                $this->all(),
                function (ShortcutInterface $shortcut) {
                    return !$shortcut->isSubShortcut();
                }
            )
        );
    }

    /**
     * Return only visible shortcuts.
     *
     * @return ShortcutCollection
     */
    public function visible()
    {
        return self::make(
            array_filter(
                $this->all(),
                function (ShortcutInterface $shortcut) {
                    return !$shortcut->isHidden();
                }
            )
        );
    }

    /**
     * Return only shortcuts with parent.
     *
     * @param $parent
     * @return static
     */
    public function children($parent)
    {
        return self::make(
            array_filter(
                $this->all(),
                function (ShortcutInterface $shortcut) use ($parent) {
                    return $shortcut->getParent() === $parent;
                }
            )
        );
    }
}
