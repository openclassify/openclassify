<?php namespace Visiosoft\LocationModule\Http\Controller\Admin;

use Illuminate\Http\Request;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\City\Form\CityFormBuilder;
use Visiosoft\LocationModule\City\Table\CityTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\LocationModule\District\DistrictModel;

class CitiesController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param CityTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * Create a new entry.
     *
     * @param CityFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(CityFormBuilder $form,Request $request)
    {
        if($this->request->action == "save") {
            if ($form->hasFormErrors()) {
                return back();
            }
            $form->make();
            return $this->redirect->to('/admin/location/cities?country='.$request->parent_country_id);
        }

        return $this->view->make('visiosoft.module.location::location/admin-sub-location');
    }

    /**
     * Edit an existing entry.
     *
     * @param CityFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(CityFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
