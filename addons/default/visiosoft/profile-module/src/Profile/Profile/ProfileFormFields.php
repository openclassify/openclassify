<?php namespace Visiosoft\ProfileModule\Profile\Profile;

use Anomaly\UsersModule\User\UserModel;

class ProfileFormFields
{
    public function handle(ProfileFormBuilder $builder, UserModel $model)
    {
        $fields = [
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

        $assignments = $model->getAssignments();
        $builder->setFields(array_merge($fields, $assignments->notLocked()->fieldSlugs()));
    }
}
