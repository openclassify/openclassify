<?php namespace Visiosoft\ProfileModule\Profile\BasicRegister;

use Visiosoft\ProfileModule\Profile\Validation\ValidateRegister;
use Visiosoft\ProfileModule\Rules\ReCaptchaRule;

class BasicRegisterFormFields
{
    public function handle(BasicRegisterFormBuilder $builder)
    {
        $captchaSiteKey = setting_value('visiosoft.module.profile::google_captcha_site_key');
        $captchaSecretKey = setting_value('visiosoft.module.profile::google_captcha_secret_key');

        $register = [];
        if ($captchaSiteKey && $captchaSecretKey) {
            $register = [
                'recaptcha_token' => [
                    'required' => true,
                    'type' => 'anomaly.field_type.text',
                    'config' => [
                        "max" => 0,
                    ],
                    'rules' => [
                        'valid_recaptcha'
                    ],
                    'validators' => [
                        'valid_recaptcha' => [
                            'message' => false,
                            'handler' => ReCaptchaRule::class
                        ]
                    ]
                ],
            ];
        }

        if (setting_value('visiosoft.module.profile::show_checkbox_terms_on_register')) {
            $register = array_merge($register, [
                "accept_protection_law" => [
                    'required' => true,
                    "type"   => "anomaly.field_type.boolean",
                    "config" => [
                        "default_value" => false,
                        "mode"          => "checkbox",
                        "label"         => 'visiosoft.module.profile::field.accept_protection_law_label',
                    ]
                ],
                "accept_privacy_terms" => [
                    'required' => true,
                    "type"   => "anomaly.field_type.boolean",
                    "config" => [
                        "default_value" => false,
                        "mode"          => "checkbox",
                        "label"         => 'visiosoft.module.profile::field.accept_privacy_terms_label',
                    ]
                ],
                "receive_sms_emails" => [
                    "type"   => "anomaly.field_type.boolean",
                    "config" => [
                        "default_value" => false,
                        "mode"          => "checkbox",
                        "label"         => 'visiosoft.module.profile::field.receive_sms_emails_label',
                    ]
                ],
            ]);
        }

        $builder->setFields(
            array_merge(
                $register,
                [
                    'username' => [
                        'required' => true,
                    ],
                    'email' => [
                        'instructions' => false,
                    ],
                    'password' => [
                        'instructions' => false,
                    ],
                ]
            )
        );
    }
}
