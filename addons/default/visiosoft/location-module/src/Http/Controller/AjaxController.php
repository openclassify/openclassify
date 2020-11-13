<?php namespace Visiosoft\LocationModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Model\Location\LocationCitiesEntryTranslationsModel;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Village\VillageModel;
use Illuminate\Support\Str;

class AjaxController extends PublicController
{
    /**
     * @var CountryModel
     */
    private $country_model;
    /**
     * @var CityModel
     */
    private $city_model;
    /**
     * @var DistrictModel
     */
    private $district_model;
    /**
     * @var NeighborhoodModel
     */
    private $neighborhood_model;
    /**
     * @var VillageModel
     */
    private $village_model;
    /**
     * @var LocationCitiesEntryTranslationsModel
     */
    private $citiesEntryTranslationsModel;

    /**
     * AjaxController constructor.
     * @param CountryModel $countryModel
     */
    public function __construct(
        CountryModel $countryModel,
        CityModel $cityModel,
        DistrictModel $districtModel,
        NeighborhoodModel $neighborhoodModel,
        VillageModel $villageModel,
        LocationCitiesEntryTranslationsModel $citiesEntryTranslationsModel
    )
    {
        $this->country_model = $countryModel;
        $this->city_model = $cityModel;
        $this->district_model = $districtModel;
        $this->neighborhood_model = $neighborhoodModel;
        $this->village_model = $villageModel;
        parent::__construct();
        $this->citiesEntryTranslationsModel = $citiesEntryTranslationsModel;
    }

    /**
     * @return mixed
     */
    public function getCountries()
    {
        if ($this->request->id)
            return $this->country_model->find($this->request->id);
        else {
            $query = $this->country_model;
            return $this->queryOrder($query);
        }
    }

    /**
     * @return mixed
     */
    public function getCities()
    {
        if ($this->request->id) {
            $id = explode(',', $this->request->id);
            $query = $this->city_model->whereIn('parent_country_id', $id);

            if (request()->order_by && $this->city_model->isTranslatedAttribute(request()->order_by)) {
                return $this->citiesEntryTranslationsModel->newQuery()
                    ->select('entry_id as id', 'name')
                    ->whereIn('locale', [
                        Request()->session()->get('_locale'),
                        setting_value('streams::default_locale'),
                        'en'
                    ])
                    ->whereIn('entry_id', $query->pluck('id')->all())
                    ->orderBy(request()->order_by)
                    ->get();
            } elseif ($orderBy = request()->order_by) {
                return $this->queryOrder($query, $orderBy);
            }

            return $this->queryOrder($query);
        }
    }

    /**
     * @return mixed
     */
    public function getDistricts()
    {
        if ($this->request->id) {
            $id = explode(',', $this->request->id);

            $query = $this->district_model->whereIn('parent_city_id', $id);

            return $this->queryOrder($query);
        }
    }

    /**
     * @return mixed
     */
    public function getNeighborhoods()
    {
        if ($this->request->id) {
            $id = explode(',', $this->request->id);

            $query = $this->neighborhood_model->whereIn('parent_district_id', $id);

            return $this->queryOrder($query);
        }
    }

    /**
     * @return mixed
     */
    public function getVillage()
    {
        if ($this->request->id) {
            $id = explode(',', $this->request->id);

            $query = $this->village_model->whereIn('parent_neighborhood_id', $id);

            return $this->queryOrder($query);
        }
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        if ($this->request->name) {
            $slug = Str::slug($this->request->name, '_');
            if ($city = $this->city_model->newQuery()->where('slug', 'LIKE', $slug . '%')->first()) {
                return ['success' => true, 'city' => $city];
            } else {
                return ['success' => false];
            }
        }
    }

    public function queryOrder($query, $orderBy = null)
    {
        $sorting_type = setting_value('visiosoft.module.location::sorting_type');
        $sorting_column = $orderBy ?: setting_value('visiosoft.module.location::sorting_column');

        return $query->orderBy($sorting_column, $sorting_type)->get();
    }
}