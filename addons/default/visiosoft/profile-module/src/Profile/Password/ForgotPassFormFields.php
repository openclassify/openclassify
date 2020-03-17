<?php namespace Visiosoft\ProfileModule\Profile\Password;

class ForgotPassFormFields
{

    /**
     * Handle the fields.
     *
     * @param ForgotPassFormBuilder $builder
     */
    public function handle(ForgotPassFormBuilder $builder)
    {
        $builder->setFields(
            [
                'email' => [
                    'type'       => 'anomaly.field_type.text',
                    'label'      => 'anomaly.module.users::field.email.name',
                    'required'   => true,
                    'rules'      => [
                        'valid_email',
                    ],
                    'validators' => [
                        'valid_email' => [
                            'handler' => 'Visiosoft\ProfileModule\Profile\Validation\ValidateEmail@handle',
                            'message' => 'visiosoft.module.profile::message.email_phone_not_found',
                        ],
                    ],
                ],
            ]
        );
    }
}
