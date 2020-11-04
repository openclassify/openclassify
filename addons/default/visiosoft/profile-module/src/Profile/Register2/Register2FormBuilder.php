<?php namespace Visiosoft\ProfileModule\Profile\Register2;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Visiosoft\ProfileModule\Profile\Register2\Command\SetOptions;
use Anomaly\UsersModule\User\UserModel;
use Visiosoft\ProfileModule\Profile\Validation\ValidateRegister;

/**
 * Class RegisterFormBuilder
 *
 * @link          http://openclassify.com/
 * @author        OpenClassify, Inc. <support@openclassify.com>
 * @author        Visiosoft Inc <support@openclassify.com>
 */
class Register2FormBuilder extends FormBuilder
{

    /**
     * The form roles.
     *
     * @var array
     */
    protected $roles = [
        'user',
    ];

    /**
     * The form model.
     *
     * @var string
     */
    protected $model = UserModel::class;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
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
    ];

    /**
     * The form actions.
     *
     * @var array
     */
    protected $actions = [
        'blue' => [
            'text' => 'anomaly.module.users::button.register',
        ],
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'redirect' => '/',
        'success_message' => 'anomaly.module.users::success.user_registered',
        'pending_message' => 'anomaly.module.users::message.pending_admin_activation',
        'confirm_message' => 'anomaly.module.users::message.pending_email_activation',
        'activated_message' => 'anomaly.module.users::message.account_activated',
    ];

    /**
     * Get the roles.
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set roles.
     *
     * @param $roles
     * @return $this
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }
}
