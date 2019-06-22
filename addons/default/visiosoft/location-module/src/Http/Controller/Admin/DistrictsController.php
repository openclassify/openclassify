<?php namespace Visiosoft\LocationModule\Http\Controller\Admin;

use Illuminate\Http\Request;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\District\Form\DistrictFormBuilder;
use Visiosoft\LocationModule\District\Table\DistrictTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;

class DistrictsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param DistrictTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * Create a new entry.
     *
     * @param DistrictFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(DistrictFormBuilder $form,Request $request)
    {
        if($this->request->action == "save") {
            if ($form->hasFormErrors()) {
                return back();
            }
            $form->make();
            return $this->redirect->to('/admin/location/districts?city='.$request->parent_city_id);
        }

        return $this->view->make('visiosoft.module.location::location/admin-sub-location');
    }

    /**
     * Edit an existing entry.
     *
     * @param DistrictFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(DistrictFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
