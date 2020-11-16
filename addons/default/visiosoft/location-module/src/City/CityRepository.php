<?php namespace Visiosoft\LocationModule\City;

use Anomaly\Streams\Platform\Model\Location\LocationCitiesEntryTranslationsModel;
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
     * @var LocationCitiesEntryTranslationsModel
     */
    private $citiesEntryTranslationsModel;

    /**
     * Create a new CityRepository instance.
     *
     * @param CityModel $model
     */
    public function __construct(CityModel $model, LocationCitiesEntryTranslationsModel $citiesEntryTranslationsModel)
    {
        $this->model = $model;
        $this->citiesEntryTranslationsModel = $citiesEntryTranslationsModel;
    }

    public function findById($id)
    {
        return $this->model->orderBy('created_at', 'DESC')->where('location_cities.id', $id)->first();
    }

    public function getByEntryIDsAndOrderByTransCol($entryIDs, $orderBy, $direction = 'asc')
    {
        return $this->citiesEntryTranslationsModel->newQuery()
            ->select('entry_id as id', 'name')
            ->whereIn('locale', [
                Request()->session()->get('_locale'),
                setting_value('streams::default_locale'),
                'en'
            ])
            ->whereIn('entry_id', $entryIDs)
            ->orderBy($orderBy, $direction)
            ->get();
    }
}
