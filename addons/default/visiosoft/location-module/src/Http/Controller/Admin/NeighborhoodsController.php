<?php namespace Visiosoft\LocationModule\Http\Controller\Admin;

use Illuminate\Http\Request;
use Visiosoft\LocationModule\Neighborhood\Form\NeighborhoodFormBuilder;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Neighborhood\Table\NeighborhoodTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\LocationModule\Village\VillageModel;

class NeighborhoodsController extends AdminController
{
    public function index(NeighborhoodTableBuilder $table, Request $request)
    {
        if($this->request->action == "delete") {
            $village = new VillageModel();
            foreach ($this->request->id as $item)
            {
                $village->deleteVillageByNeighborhood($item);
            }
        }
        $neighborhoods = new NeighborhoodModel();
        if(!isset($request->district) || $request->district==""){
            return $table->render();
        }else{
            $neighborhoods = $neighborhoods->getSubNeighborhoods($request->district);
            if (count($neighborhoods) == 0) {
                $this->messages->error('Selected district has no related neighborhood.');
                return redirect('/admin/location/districts');
            }
        }
        $table->setTableEntries($neighborhoods);
        return $table->render();
    }

    public function create(NeighborhoodFormBuilder $form)
    {
        $form->setDistrict($this->request->get('neighborhoods'));

        return $form->render();
    }

    public function edit(NeighborhoodFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
