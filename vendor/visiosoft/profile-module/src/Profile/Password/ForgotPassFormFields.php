<?php namespace Visiosoft\ProfileModule\Profile\Password;

class ForgotPassFormFields
{
    public function handle(ForgotPassFormBuilder $builder)
    {
        $resetTypeOptions = [
            'mail' => 'visiosoft.theme.base::field.mail',
        ];
        if (is_module_installed('visiosoft.module.sms')) {
            $resetTypeOptions['sms'] = 'visiosoft.theme.base::field.sms';
        }

        $builder->setFields(
            [
                'email' => [
                    'type' => 'anomaly.field_type.text',
                    'label' => 'anomaly.module.users::field.email.name',
                    'required' => true,
                    'rules' => [
                        'valid_email',
                    ],
                    'validators' => [
                        'valid_email' => [
                            'handler' => 'Visiosoft\ProfileModule\Profile\Validation\ValidateEmail@handle',
                            'message' => 'visiosoft.module.profile::message.email_phone_not_found',
                        ],
                    ],
                ],
                "resetType" => [
                    "type" => "anomaly.field_type.select",
                    "config" => [
                        "options" => $resetTypeOptions,
                        "separator" => ":",
                        "default_value" => 'mail',
                        "mode" => "radio",
                    ]
                ]
            ]
        );
    }
}
