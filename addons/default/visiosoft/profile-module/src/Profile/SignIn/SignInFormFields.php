<?php namespace Visiosoft\ProfileModule\Profile\SignIn;

use Illuminate\Contracts\Config\Repository;

class SignInFormFields
{
    public function handle(SignInFormBuilder $builder, Repository $config)
    {
        $method = $config->get('anomaly.module.users::config.login');

        if ($method == 'username') {
            $login = [
                'username' => [
                    'label'    => 'anomaly.module.users::field.username.name',
                    'type'     => 'anomaly.field_type.text',
                    'required' => true,
                ],
            ];
        } else {
            $login = [
                'email' => [
                    'label'    => 'anomaly.module.users::field.email.name',
                    'type'     => 'anomaly.field_type.text',
                    'required' => true,
                ],
            ];
        }

        $builder->setFields(
            array_merge(
                $login,
                [
                    'password'    => [
                        'label'      => 'anomaly.module.users::field.password.name',
                        'type'       => 'anomaly.field_type.text',
                        'required'   => true,
                        'config'     => [
                            'type' => 'password',
                        ],
                        'rules'      => [
                            'valid_credentials',
                        ],
                        'validators' => [
                            'valid_credentials' => [
                                'handler' => 'Visiosoft\ProfileModule\Profile\Validation\ValidateCredentials@handle',
                                'message' => 'anomaly.module.users::message.invalid_login',
                            ],
                        ],
                    ],
                    'remember_me' => [
                        'label'  => false,
                        'type'   => 'anomaly.field_type.boolean',
                        'config' => [
                            'mode'  => 'checkbox',
                            'label' => 'anomaly.module.users::field.remember_me.name',
                        ],
                    ],
                ]
            )
        );
    }
}
