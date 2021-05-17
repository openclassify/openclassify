<?php namespace Visiosoft\ProfileModule\Profile\Profile;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\UserModel;

class ProfileFormBuilder extends FormBuilder
{
    protected $model = UserModel::class;

    protected $fields = [
        'gsm_phone',
        'office_phone',
        'land_phone',
        'identification_number',
        'education' => [
	        'type' => 'anomaly.field_type.select',
	        'config' => [
		        'handler' => 'Visiosoft\ProfileModule\OptionHandler\EducationOptions@handle',
	        ]
        ],
        'education_part' => 'anomaly.field_type.select',
        'profession',
        'birthday',
        'register_type',
	    'facebook_address',
	    'google_address',
    ];

    protected $actions = [
        'update' => [
            'text' => 'visiosoft.module.profile::button.update_profile'
        ],
    ];
}
