<?php namespace Visiosoft\LocationModule\Http\Controller\Admin;

use Illuminate\Http\Request;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\District\Form\DistrictFormBuilder;
use Visiosoft\LocationModule\District\Table\DistrictTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;

class DistrictsController extends AdminController
{
    public function index(DistrictTableBuilder $table, Request $request)
    {
        if($this->request->action == "delete") {
            $neighborhoods = new NeighborhoodModel();
            foreach ($this->request->id as $item)
            {
                $neighborhoods->deleteNeighborhoodByDistrict($item);
            }
        }
        $districts = new DistrictModel();
        if(!isset($request->city) || $request->city==""){
            return $table->render();
        }else{
            $districts = $districts->getSubDistricts($request->city);
            if (count($districts) == 0) {
                $this->messages->error('Selected city has no related district.');
                return redirect('/admin/location/cities');
            }
        }
        $table->setTableEntries($districts);
        return $table->render();
    }

    public function create(DistrictFormBuilder $form)
    {
        $form->setCity($this->request->get('districts'));

        return $form->render();
    }

    public function edit(DistrictFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
