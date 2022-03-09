<?php namespace Anomaly\DashboardModule\Dashboard;

use Anomaly\DashboardModule\Dashboard\Contract\DashboardInterface;
use Anomaly\DashboardModule\Dashboard\Contract\DashboardRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class DashboardRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DashboardRepository extends EntryRepository implements DashboardRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var DashboardModel
     */
    protected $model;

    /**
     * Create a new DashboardRepository instance.
     *
     * @param DashboardModel $model
     */
    public function __construct(DashboardModel $model)
    {
        $this->model = $model;
    }

    /**
     * Return only allowed dashboards.
     *
     * @return DashboardCollection
     */
    public function allowed()
    {
        return $this->model->all()->allowed();
    }

    /**
     * Find a dashboard by it's slug.
     *
     * @param $slug
     * @return null|DashboardInterface
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
