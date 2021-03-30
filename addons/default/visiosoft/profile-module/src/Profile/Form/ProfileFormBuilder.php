<?php namespace Visiosoft\ProfileModule\Profile\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\Validation\ValidateEmail;

class ProfileFormBuilder extends FormBuilder
{
    protected $fields = [
        'email'     => [
            'instructions' => false,
            'rules'        => [
                'valid_email',
            ],
            'validators'   => [
                'valid_email' => [
                    'message' => false,
                    'handler' => ValidateEmail::class,
                ],
            ],
        ],
    ];

    protected $buttons = [
        'cancel',
    ];
}
