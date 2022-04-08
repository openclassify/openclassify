<?php namespace Anomaly\BlocksModule\Area\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface AreaRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface AreaRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find an area by it's slug.
     *
     * @param $slug
     * @return AreaInterface|null
     */
    public function findBySlug($slug);
    
}
