<?php namespace Visiosoft\ProfileModule\Http\Controller;

use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class AddressController extends AdminController
{

    private $adressRepository;

    public function __construct(AdressRepositoryInterface $adressRepository)
    {
        parent::__construct();
        $this->adressRepository = $adressRepository;
    }

    public function index()
    {
        $address = $this->adressRepository->getUserAddresses();
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
        $address = $this->adressRepository->find($id);

        if ($address->user_id == \auth()->id()) {
            $address->delete();
        }

        return $this->redirect->back();
    }
}
