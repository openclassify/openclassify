<?php namespace Visiosoft\CustomfieldsModule\Cfvalue\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class CfvalueFormBuilder extends FormBuilder
{
    protected $buttons = [
        'cancel',
    ];

    protected $assets = [
        'scripts.js' => [
            'visiosoft.module.customfields::js/admin/cfValue/cfValue.js'
        ],
    ];

    public function onSaving()
    {
        $entry = $this->getFormEntry();
        $type  = request()->type;

        if ($type) {
            $entry->custom_field_id = $type;
        }
    }

}
