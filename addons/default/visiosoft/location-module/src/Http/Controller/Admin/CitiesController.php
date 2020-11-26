<?php namespace Visiosoft\LocationModule\Http\Controller\Admin;

use Illuminate\Http\Request;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\City\Form\CityFormBuilder;
use Visiosoft\LocationModule\City\Table\CityTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\LocationModule\District\DistrictModel;

class CitiesController extends AdminController
{
    public function index(CityTableBuilder $table, Request $request)
    {
        if($this->request->action == "delete") {
            $disticts = new DistrictModel();
            foreach ($this->request->id as $item)
            {
                $disticts->deleteDistrictByCity($item);
            }
        }
        $cities = new CityModel();
        if(!isset($request->country) || $request->country==""){
            return $table->render();
        }else{
            $cities = $cities->getSubCities($request->country);
            if (count($cities) == 0) {
                $this->messages->error('Selected country has no related city.');
                return redirect('/admin/location/countries');
            }
        }
        $table->setTableEntries($cities);
        return $table->render();
    }

    public function create(CityFormBuilder $form)
    {
        $form->setCountry($this->request->get('cities'));

        return $form->render();
    }

    public function edit(CityFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
