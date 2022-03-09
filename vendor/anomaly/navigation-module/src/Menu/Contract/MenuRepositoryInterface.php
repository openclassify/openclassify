<?php namespace Anomaly\NavigationModule\Menu\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface MenuRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface MenuRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a menu by it's slug.
     *
     * @param $slug
     * @return null|MenuInterface
     */
    public function findBySlug($slug);
}
