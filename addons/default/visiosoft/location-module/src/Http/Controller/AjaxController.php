<?php namespace Visiosoft\LocationModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\LocationModule\District\Contract\DistrictRepositoryInterface;
use Visiosoft\LocationModule\Neighborhood\Contract\NeighborhoodRepositoryInterface;
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;
use Illuminate\Support\Str;

class AjaxController extends PublicController
{
    private $cityRepository;
    private $countryRepository;
    private $districtRepository;
    private $neighborhoodRepository;
    private $villageRepository;

    public function __construct(
        CityRepositoryInterface $cityRepository,
        CountryRepositoryInterface $countryRepository,
        DistrictRepositoryInterface $districtRepository,
        NeighborhoodRepositoryInterface $neighborhoodRepository,
        VillageRepositoryInterface $villageRepository
    )
    {
        parent::__construct();
        $this->cityRepository = $cityRepository;
        $this->countryRepository = $countryRepository;
        $this->districtRepository = $districtRepository;
        $this->neighborhoodRepository = $neighborhoodRepository;
        $this->villageRepository = $villageRepository;
    }

    public function getCountries()
    {
        if ($this->request->id)
            return $this->countryRepository->getModel()->find($this->request->id);
        else {
            $query = $this->countryRepository->getModel();
            return $this->queryOrder($query, $this->countryRepository);
        }
    }

    public function getCities()
    {
        if ($this->request->id) {
            $id = explode(',', $this->request->id);
            $query = $this->cityRepository->getModel()->whereIn('parent_country_id', $id);

            if ($this->request->search) {
                $query->leftJoin('location_cities_translations', 'location_cities.id', '=', 'location_cities_translations.entry_id')
                    ->where('location_cities_translations.name', 'like', '%' . $this->request->search . '%');
            }

            return $this->queryOrder($query, $this->cityRepository);
        }
    }

    public function getDistricts()
    {
        if ($this->request->id) {
            $id = explode(',', $this->request->id);

            $query = $this->districtRepository->getModel()->whereIn('parent_city_id', $id);

            return $this->queryOrder($query, $this->districtRepository);
        }
    }

    public function getNeighborhoods()
    {
        if ($this->request->id) {
            $id = explode(',', $this->request->id);

            $query = $this->neighborhoodRepository->getModel()->whereIn('parent_district_id', $id);

            return $this->queryOrder($query, $this->neighborhoodRepository);
        }
    }

    public function getVillage()
    {
        if ($this->request->id) {
            $id = explode(',', $this->request->id);

            $query = $this->villageRepository->getModel()->whereIn('parent_neighborhood_id', $id);

            return $this->queryOrder($query, $this->villageRepository);
        }
    }

    public function getCity()
    {
        if ($this->request->name) {
            $slug = Str::slug($this->request->name, '_');
            if ($city = $this->cityRepository->getModel()->newQuery()->where('slug', 'LIKE', $slug . '%')->first()) {
                return ['success' => true, 'city' => $city];
            } else {
                return ['success' => false];
            }
        }
    }

    public function queryOrder($query, $repository)
    {
        $sorting_type = setting_value('visiosoft.module.location::sorting_type');
        $sorting_column = setting_value('visiosoft.module.location::sorting_column');

        if ($repository->getModel()->isTranslatedAttribute($sorting_column)) {
            return $repository->getByEntryIDsAndOrderByTransCol(
                $query->get()->pluck('id')->all(),
                $sorting_column,
                $sorting_type
            );
        }

        return $query->orderBy($sorting_column, $sorting_type)->get();
    }

    public function findLocation()
    {
        try {
            $validator = Validator::make(request()->all(), [
                'type' => [
                    'required',
                    Rule::in(['countries', 'cities', 'districts', 'neighborhoods', 'village'])
                ],
                'id' => 'required|exists:location_' . request()->type,
            ]);

            if ($validator->fails()) {
                throw new \Exception($validator->messages()->first());
            }

            $dBName = 'location_' . request()->type;
            $location = DB::table($dBName)
                ->join(
                    $dBName . '_translations as location_trans',
                    $dBName . '.id',
                    '=',
                    'location_trans.entry_id'
                )
                ->where($dBName . '.id', request()->id)
                ->first();

            return [
                'success' => true,
                'data' => $location
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'msg' => $e->getMessage()
            ];
        }

    }
}
