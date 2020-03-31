<?php namespace Visiosoft\LocationModule\Village;

use Visiosoft\LocationModule\Village\Contract\VillageInterface;
use Anomaly\Streams\Platform\Model\Location\LocationVillageEntryModel;

class VillageModel extends LocationVillageEntryModel implements VillageInterface
{
    public function getVillages() {
        return VillageModel::all();
    }

    public function getSubVillages($neighborhood) {
        return $this->query()->where('parent_neighborhood_id', $neighborhood)->orderBy('order','ASC')->get();
    }

    public function deleteVillageByNeighborhood($id) {
        $this->where('parent_neighborhood_id',$id)->orderBy('id','DESC')->delete();
    }
}
