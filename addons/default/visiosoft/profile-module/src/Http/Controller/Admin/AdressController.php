<?php namespace Visiosoft\ProfileModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Model\Profile\ProfileAdressEntryModel;
use Anomaly\Streams\Platform\Model\Users\UsersUsersEntryModel;
use Illuminate\Http\Request;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\ProfileModule\Adress\AdressModel;
use Visiosoft\ProfileModule\Adress\Form\AdressFormBuilder;
use Visiosoft\ProfileModule\Adress\Table\AdressTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class AdressController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param AdressTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AdressTableBuilder $table)
    {
        $users = UsersUsersEntryModel::query()->get();
        $table->setTableEntries($users);
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param AdressFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(AdressFormBuilder $form)
    {
        return $this->view->make('visiosoft.module.profile::admin/adress/create');
    }

    /**
     * Edit an existing entry.
     *
     * @param AdressFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(AdressFormBuilder $form, $id)
    {
        $adress = ProfileAdressEntryModel::query()->find($id);
        $country = CountryModel::all();
        return $this->view->make('visiosoft.module.profile::admin/adress/edit',compact('adress','country'));
    }

    public function adresList(AdressTableBuilder $table, $id)
    {
        $table->setColumns(['adress_name','user']);
        $table->setButtons(['edit' => [
            'href' => '/admin/profile/adress/editAdress/{entry.id}',
        ],]);
        return $table->render();
    }

    public function adressUpdate(AdressFormBuilder $form,Request $request,$id)
    {
        $error = $form->build()->validate()->getFormErrors()->getMessages();
        if(!empty($error))
        {
            return $this->redirect->back();
        }
        $New_value = $request->all();
        unset($New_value['_token'],$New_value['action']);
        ProfileAdressEntryModel::find($id)->update($New_value);
        $message = [];
        $message[] = trans('visiosoft.module.profile::message.adress_success_update');
        if($request->get('action') == "save_create")
        {
            return redirect('admin/profile/adress/create')->with('success', $message);
        }
        return $this->redirect->back()->with('success', $message);
    }
}
