<?php namespace Anomaly\NavigationModule\Link\Contract;

use Anomaly\NavigationModule\Link\LinkCollection;
use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface LinkRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface LinkRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Return links belonging to
     * the provided menu.
     *
     * @param  MenuInterface  $menu
     * @return LinkCollection
     */
    public function findAllByMenu(MenuInterface $menu);
}
