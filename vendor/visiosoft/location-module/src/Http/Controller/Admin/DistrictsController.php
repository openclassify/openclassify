<?php namespace Visiosoft\LocationModule\Http\Controller\Admin;

use Illuminate\Http\Request;
use Visiosoft\LocationModule\District\Contract\DistrictRepositoryInterface;
use Visiosoft\LocationModule\District\Form\DistrictFormBuilder;
use Visiosoft\LocationModule\District\Table\DistrictTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class DistrictsController extends AdminController
{
    public function index(DistrictTableBuilder $table, Request $request)
    {
        $districts = app(DistrictRepositoryInterface::class);
        if(!isset($request->city) || $request->city==""){
            return $table->render();
        }else{
            $districts = $districts->getDistrictByCityId($request->city);
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
