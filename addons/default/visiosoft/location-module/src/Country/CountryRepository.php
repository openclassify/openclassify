<?php namespace Visiosoft\LocationModule\Country;

use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

class CountryRepository extends EntryRepository implements CountryRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var CountryModel
     */
    protected $model;

    /**
     * Create a new CountryRepository instance.
     *
     * @param CountryModel $model
     */
    public function __construct(CountryModel $model)
    {
        $this->model = $model;
    }
    public function findById($id)
    {
        return $this->model->orderBy('created_at', 'DESC')->where('location_countries.id', $id)->first();
    }

    public function viewAll(){
        return $this->model->get();
    }
}
