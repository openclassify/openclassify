<?php namespace Visiosoft\ProfileModule\Adress\FormCompany;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Visiosoft\ProfileModule\Adress\AdressModel;

class AddressCompanyFormBuilder extends FormBuilder
{
    protected $model = AdressModel::class;

    protected $buttons = [
        'cancel',
    ];

    protected $options = [
        'redirect' => '/profile/address',
        'success_message' => 'visiosoft.module.profile::message.adress_success_create',
    ];
}
