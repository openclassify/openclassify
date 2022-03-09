<?php namespace Anomaly\BlocksModule\Area;

use Anomaly\BlocksModule\Area\Contract\AreaInterface;
use Anomaly\BlocksModule\Area\Contract\AreaRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class AreaRepository extends EntryRepository implements AreaRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var AreaModel
     */
    protected $model;

    /**
     * Create a new AreaRepository instance.
     *
     * @param AreaModel $model
     */
    public function __construct(AreaModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find an area by it's slug.
     *
     * @param $slug
     * @return AreaInterface|null
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
