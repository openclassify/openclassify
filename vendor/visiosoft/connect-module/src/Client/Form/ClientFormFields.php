<?php namespace Visiosoft\ConnectModule\Client\Form;

use Anomaly\UsersModule\User\UserModel;

class ClientFormFields
{
    public function handle(ClientFormBuilder $builder)
    {
        $builder->setFields(
            [
                'user_id'  => [
                    'required'     => true,
                    'label'        => 'visiosoft.module.connect::field.user.name',
                    'instructions' => 'visiosoft.module.connect::field.user.instructions',
                    'type'         => 'anomaly.field_type.relationship',
                    'config'       => [
                        'mode'    => 'lookup',
                        'related' => UserModel::class,
                    ],
                ],
                'name'     => [
                    'required'     => true,
                    'label'        => 'visiosoft.module.connect::field.name.name',
                    'instructions' => 'visiosoft.module.connect::field.name.instructions',
                    'type'         => 'anomaly.field_type.text',
                ],
                'redirect' => [
                    'required'     => true,
                    'label'        => 'visiosoft.module.connect::field.redirect.name',
                    'instructions' => 'visiosoft.module.connect::field.redirect.instructions',
                    'type'         => 'anomaly.field_type.url',
                    'value' => url('/auth/callback'),
                ],
            ]
        );
    }
}
