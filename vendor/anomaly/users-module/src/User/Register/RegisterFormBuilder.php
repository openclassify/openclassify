<?php namespace Anomaly\UsersModule\User\Register;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\Register\Command\AssociateActivationRoles;
use Anomaly\UsersModule\User\UserModel;
use Anomaly\UsersModule\User\Validation\ValidatePassword;

/**
 * Class RegisterFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RegisterFormBuilder extends FormBuilder
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
        'display_name' => [
            'instructions' => false,
        ],
        'username'     => [
            'instructions' => false,
        ],
        'email'        => [
            'instructions' => false,
        ],
        'password'     => [
            'instructions' => false,
            'rules'        => [
                'valid_password',
            ],
            'validators'   => [
                'valid_password' => [
                    'message' => false,
                    'handler' => ValidatePassword::class,
                ],
            ],
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
        'redirect'          => '/',
        'success_message'   => 'anomaly.module.users::success.user_registered',
        'pending_message'   => 'anomaly.module.users::message.pending_admin_activation',
        'confirm_message'   => 'anomaly.module.users::message.pending_email_activation',
        'activated_message' => 'anomaly.module.users::message.account_activated',
    ];

    /**
     * Fired after the form is saved.
     */
    public function onSaved()
    {
        $this->dispatch(new AssociateActivationRoles($this));
    }

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
