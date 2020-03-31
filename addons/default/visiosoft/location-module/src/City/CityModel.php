<?php namespace Visiosoft\LocationModule\City;

use Visiosoft\LocationModule\City\Contract\CityInterface;
use Anomaly\Streams\Platform\Model\Location\LocationCitiesEntryModel;
use Visiosoft\LocationModule\District\DistrictModel;

class CityModel extends LocationCitiesEntryModel implements CityInterface
{
    public function getCities($id = null) {
        if($id != null)
        {
            return CityModel::query()->where('location_cities.id', $id)->first();
        }
       return CityModel::all();
    }

    public function getSubCities($country) {
       return $this->query()->where('parent_country_id', $country)->orderBy('order','ASC')->get();
    }

    public function deleteCitiesByCountry($id) {
        $districts = new DistrictModel();
        $city = $this->where('parent_country_id',$id);
        $city_id = $city->orderBy('id','DESC')->get();
        foreach ($city_id as $item)
        {
            $districts->deleteDistrictByCity($item->id);
        }
        return $city->delete();
    }
}
