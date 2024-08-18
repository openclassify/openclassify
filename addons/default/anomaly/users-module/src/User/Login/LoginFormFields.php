<?php namespace Anomaly\UsersModule\User\Login;

use Illuminate\Contracts\Config\Repository;

/**
 * Class LoginFormFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LoginFormFields
{

    /**
     * Handle the fields.
     *
     * @param LoginFormBuilder $builder
     * @param Repository       $config
     */
    public function handle(LoginFormBuilder $builder, Repository $config)
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
                    'type'     => 'anomaly.field_type.email',
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
                                'handler' => 'Anomaly\UsersModule\User\Validation\ValidateCredentials@handle',
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
