<?php namespace Visiosoft\LocationModule\City;

use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class CityRepository extends EntryRepository implements CityRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var CityModel
     */
    protected $model;

    /**
     * Create a new CityRepository instance.
     *
     * @param CityModel $model
     */
    public function __construct(CityModel $model)
    {
        $this->model = $model;
    }

    public function findById($id)
    {
        return $this->model->orderBy('created_at', 'DESC')->where('location_cities.id', $id)->first();
    }
}
