<?php namespace Anomaly\UsersModule\User\Password;

/**
 * Class ForgotPasswordFormFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ForgotPasswordFormFields
{

    /**
     * Handle the fields.
     *
     * @param ForgotPasswordFormBuilder $builder
     */
    public function handle(ForgotPasswordFormBuilder $builder)
    {
        $builder->setFields(
            [
                'email' => [
                    'type'       => 'anomaly.field_type.email',
                    'label'      => 'anomaly.module.users::field.email.name',
                    'required'   => true,
                    'rules'      => [
                        'valid_email',
                    ],
                    'validators' => [
                        'valid_email' => [
                            'handler' => 'Anomaly\UsersModule\User\Validation\ValidateEmail@handle',
                            'message' => 'anomaly.module.users::message.invalid_email',
                        ],
                    ],
                ],
            ]
        );
    }
}
