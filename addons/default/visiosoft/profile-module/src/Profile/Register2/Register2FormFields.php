<?php namespace Visiosoft\ProfileModule\Profile\Register2;

use Visiosoft\ProfileModule\Profile\Validation\ValidateRegister;
use Visiosoft\ProfileModule\Rules\ReCaptchaRule;

class Register2FormFields
{
    public function handle(Register2FormBuilder $builder)
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

        $builder->setFields(
            array_merge(
                $register,
                [
                    'username' => [
                        'required' => true,
                    ],
                    'first_name' => [
                        'instructions' => false,
                        'required' => true,
                    ],
                    'last_name' => [
                        'instructions' => false,
                        'required' => true,
                    ],
                    'phone' => [
                        'type' => 'anomaly.field_type.text',
                        'required' => true,
                        'rules' => [
                            'valid_register',
                        ],
                        'validators' => [
                            'valid_register' => [
                                'message' => false,
                                'handler' => ValidateRegister::class,
                            ],
                        ],
                    ],
                    'email' => [
                        'instructions' => false,
                    ],
                    'password' => [
                        'instructions' => false,
                    ],
                    "accept_terms" => [
                        "type"   => "anomaly.field_type.boolean",
                        "required" => true,
                        "config" => [
                            "default_value" => false,
                            "mode"          => "checkbox",
                            "label"         => 'visiosoft.module.profile::field.accept_terms_label',
                        ]
                    ],
                    "accept_protection_law" => [
                        "type"   => "anomaly.field_type.boolean",
                        "required" => true,
                        "config" => [
                            "default_value" => false,
                            "mode"          => "checkbox",
                            "label"         => 'visiosoft.module.profile::field.accept_protection_law_label',
                        ]
                    ],
                    "accept_privacy_terms" => [
                        "type"   => "anomaly.field_type.boolean",
                        "required" => true,
                        "config" => [
                            "default_value" => false,
                            "mode"          => "checkbox",
                            "label"         => 'visiosoft.module.profile::field.accept_privacy_terms_label',
                        ]
                    ],
                    "receive_sms_emails" => [
                        "type"   => "anomaly.field_type.boolean",
                        "required" => true,
                        "config" => [
                            "default_value" => false,
                            "mode"          => "checkbox",
                            "label"         => 'visiosoft.module.profile::field.receive_sms_emails_label',
                        ]
                    ],
                ]
            )
        );
    }
}
