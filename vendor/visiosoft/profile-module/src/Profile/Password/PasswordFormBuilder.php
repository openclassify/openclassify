<?php namespace Visiosoft\ProfileModule\Profile\Password;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class PasswordFormBuilder extends FormBuilder
{
    protected $fields = [
        'old_password' => [
            'type' => 'anomaly.field_type.text',
            'required' => true,
            'config' => [
                'type' => 'password'
            ],
        ],
        'new_password' => [
            'type' => 'anomaly.field_type.text',
            'required' => true,
            'config' => [
                'type' => 'password'
            ],
        ],
        're_new_password' => [
            'type' => 'anomaly.field_type.text',
            'required' => true,
            'config' => [
                'type' => 'password'
            ],
        ],
    ];

    protected $actions = [
        'update' => [
            'text' => 'visiosoft.module.profile::button.update_password'
        ],
    ];
}
