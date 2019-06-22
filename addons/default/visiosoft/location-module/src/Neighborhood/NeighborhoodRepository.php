<?php namespace Visiosoft\LocationModule\Neighborhood;

use Visiosoft\LocationModule\Neighborhood\Contract\NeighborhoodRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class NeighborhoodRepository extends EntryRepository implements NeighborhoodRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var NeighborhoodModel
     */
    protected $model;

    /**
     * Create a new NeighborhoodRepository instance.
     *
     * @param NeighborhoodModel $model
     */
    public function __construct(NeighborhoodModel $model)
    {
        $this->model = $model;
    }
}
