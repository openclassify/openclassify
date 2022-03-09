<?php namespace Anomaly\DashboardModule\Dashboard\Contract;

use Anomaly\DashboardModule\Dashboard\DashboardCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface DashboardRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface DashboardRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Return only allowed dashboards.
     *
     * @return DashboardCollection
     */
    public function allowed();

    /**
     * Find a dashboard by it's slug.
     *
     * @param $slug
     * @return null|DashboardInterface
     */
    public function findBySlug($slug);
}
