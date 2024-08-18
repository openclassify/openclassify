<?php namespace Visiosoft\CustomfieldsModule\CustomField\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class CustomFieldFormBuilder extends FormBuilder
{
    protected $buttons = [
        'cancel',
    ];

    protected $options = [
        'form_view' => 'visiosoft.module.customfields::admin/customfields/form',
        'redirect' => 'admin/customfields'
    ];
}
