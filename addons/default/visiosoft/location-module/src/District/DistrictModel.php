<?php namespace Visiosoft\LocationModule\District;

use Visiosoft\LocationModule\District\Contract\DistrictInterface;
use Anomaly\Streams\Platform\Model\Location\LocationDistrictsEntryModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;

class DistrictModel extends LocationDistrictsEntryModel implements DistrictInterface
{
    public function getDistricts() {
        return DistrictModel::all();
    }

    public function getSubDistricts($city) {
        return $this->query()->where('parent_city_id', $city)->get();
    }

    public function deleteDistrictByCity($id) {
        $neighborhood = new NeighborhoodModel();
        $districts = $this->where('parent_city_id',$id);
        $districts_id = $districts->get();
        foreach ($districts_id as $item)
        {
            $neighborhood->deleteNeighborhoodByDistrict($item->id);
        }
        return $districts->delete();
    }
}
