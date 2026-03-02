<?php namespace Visiosoft\LocationModule\Http\Controller\Admin;

use Illuminate\Http\Request;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\LocationModule\City\Form\CityFormBuilder;
use Visiosoft\LocationModule\City\Table\CityTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;

class CitiesController extends AdminController
{
    public function index(CityTableBuilder $table, Request $request)
    {
        $cities = app(CityRepositoryInterface::class);

        if(!isset($request->country) || $request->country==""){
            return $table->render();
        } else {
            $cities = $cities->getCitiesByCountryId($request->country);
            if (count($cities) == 0) {
                $this->messages->error('Selected country has no related city.');
                return redirect('/admin/location/countries');
            }
        }
        $table->setTableEntries($cities);
        return $table->render();
    }

    public function choose(CountryRepositoryInterface $countryRepository)
    {
        $countries = $countryRepository->all();

        return $this->view->make('visiosoft.module.location::admin/fields/choose', ['countries' => $countries]);
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
