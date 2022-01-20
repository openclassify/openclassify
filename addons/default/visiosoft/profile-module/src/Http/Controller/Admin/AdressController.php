<?php namespace Visiosoft\ProfileModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\Profile\ProfileAdressEntryModel;
use Illuminate\Http\Request;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\ProfileModule\Adress\Form\AdressFormBuilder;
use Visiosoft\ProfileModule\Adress\Table\AdressTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class AdressController extends AdminController
{
    public function index(AdressTableBuilder $table)
    {
        $table->setColumns(array_merge($table->getColumns(), [
            'city' => [
                'value' => function (EntryInterface $entry, CityRepositoryInterface $cityRepository) {
                    $city = $cityRepository->find($entry->city);
                    return ($city) ? $city->name : '-';
                },
            ],
        ]));

        return $table->render();
    }

    public function create(AdressFormBuilder $form)
    {
        $form->setOption('heading', "visiosoft.module.profile::field");

        return $form->render();
    }

    public function edit(AdressFormBuilder $form, $id)
    {
        $form->setOption('heading', "visiosoft.module.profile::field");

        return $form->render($id);
    }

    public function adressUpdate(AdressFormBuilder $form, Request $request, $id)
    {
        $error = $form->build()->validate()->getFormErrors()->getMessages();

        if (!empty($error)) {
            return $this->redirect->back();
        }

        $New_value = $request->all();
        unset($New_value['_token'], $New_value['action']);
        ProfileAdressEntryModel::find($id)->update($New_value);
        $message = [];
        $message[] = trans('visiosoft.module.profile::message.adress_success_update');
        if ($request->get('action') == "save_create") {
            return redirect('admin/profile/adress/create')->with('success', $message);
        }

        return $this->redirect->back()->with('success', $message);
    }
}
