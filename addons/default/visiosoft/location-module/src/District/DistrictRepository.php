<?php namespace Visiosoft\LocationModule\District;

use Visiosoft\LocationModule\District\Contract\DistrictRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class DistrictRepository extends EntryRepository implements DistrictRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var DistrictModel
     */
    protected $model;

    /**
     * Create a new DistrictRepository instance.
     *
     * @param DistrictModel $model
     */
    public function __construct(DistrictModel $model)
    {
        $this->model = $model;
    }
}
