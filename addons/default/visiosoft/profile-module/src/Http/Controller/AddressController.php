<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\Profile\ProfileAdressEntryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\ProfileModule\Adress\AdressModel;
use Visiosoft\ProfileModule\Adress\Form\AdressFormBuilder;
use Visiosoft\ProfileModule\Adress\Table\AdressTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class AddressController extends AdminController
{
    private $address;

    public function __construct(AdressModel $address)
    {
        $this->address = $address;
        parent::__construct();
    }

    public function index(AdressTableBuilder $table)
    {
        $address = $this->address->getUserAdress();
        return $this->view->make('visiosoft.module.profile::address/list', compact('address'));
    }

    public function create()
    {
        return $this->view->make('visiosoft.module.profile::address/create');
    }

    public function edit($id)
    {
        return $this->view->make('visiosoft.module.profile::address/create', compact('id'));

    }

    public function delete($id)
    {
        $address = $this->address->newQuery()->find($id);

        if ($address->user_id == Auth::id()) {
            $address->delete();
        }

        return $this->redirect->back();
    }
}
