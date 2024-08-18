<?php namespace Visiosoft\LocationModule\District;

use Anomaly\Streams\Platform\Model\Location\LocationDistrictsEntryTranslationsModel;
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
     * @var LocationDistrictsEntryTranslationsModel
     */
    private $districtsEntryTranslationsModel;

    /**
     * Create a new DistrictRepository instance.
     *
     * @param DistrictModel $model
     */
    public function __construct(
        DistrictModel $model,
        LocationDistrictsEntryTranslationsModel $districtsEntryTranslationsModel
    )
    {
        $this->model = $model;
        $this->districtsEntryTranslationsModel = $districtsEntryTranslationsModel;
    }

    public function getByEntryIDsAndOrderByTransCol($entryIDs, $orderBy, $direction = 'asc')
    {
        return $this->districtsEntryTranslationsModel->newQuery()
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

    public function getDistrictByCityId($city) {
        return $this->newQuery()
            ->where('parent_city_id', $city)
            ->orderBy('order','ASC')
            ->get();
    }

    public function findAllByIDs($districtIDs) {
        return $this->newQuery()
            ->whereIn('location_districts.id', $districtIDs)
            ->get();
    }
    public function findBySlug($districtSlug) {
        return $this->newQuery()
            ->where('location_districts.slug', $districtSlug)
            ->get();
    }
}
