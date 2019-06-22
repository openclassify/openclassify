<?php namespace Visiosoft\LocationModule\Neighborhood;

use Visiosoft\LocationModule\Neighborhood\Contract\NeighborhoodInterface;
use Anomaly\Streams\Platform\Model\Location\LocationNeighborhoodsEntryModel;
use Visiosoft\LocationModule\Village\VillageModel;

class NeighborhoodModel extends LocationNeighborhoodsEntryModel implements NeighborhoodInterface
{
    public function getNeighborhoods() {
        return NeighborhoodModel::all();
    }

    public function getSubNeighborhoods($district) {
        return $this->query()->where('parent_district_id', $district)->get();
    }

    public function deleteNeighborhoodByDistrict($id) {
        $village = new VillageModel();
        $neighborhood = $this->where('parent_district_id',$id);
        $neighborhoods_id = $neighborhood->get();
        foreach ($neighborhoods_id as $item)
        {
            $village->deleteVillageByNeighborhood($item->id);
        }
        return $neighborhood->delete();
    }
}
