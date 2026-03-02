<?php namespace Visiosoft\ProfileModule\Adress\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class AdressFormBuilder extends FormBuilder
{
    protected $buttons = [
        'cancel',
    ];

    protected $options = [
        'redirect' => '/profile/address',
        'success_message' => 'visiosoft.module.profile::message.adress_success_create',
    ];
}
