<?php namespace Anomaly\UsersModule\User\Impersonation;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Translation\Translator;

/**
 * Class ImpersonationFormBuilder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ImpersonationFormBuilder extends FormBuilder
{

    /**
     * The user to impersonate.
     *
     * @var UserInterface|null
     */
    protected $user = null;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'password' => [
            'label'        => 'anomaly.module.users::field.password.name',
            'instructions' => 'anomaly.module.users::field.password.impersonate',
            'type'         => 'anomaly.field_type.text',
            'required'     => true,
            'config'       => [
                'type' => 'password',
            ],
            'rules'        => [
                'valid_credentials',
            ],
            'validators'   => [
                'valid_credentials' => [
                    'handler' => 'Anomaly\UsersModule\User\Validation\ValidateAuthentication@handle',
                    'message' => 'anomaly.module.users::message.invalid_password',
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
        'submit',
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'permission' => 'anomaly.module.users::users.impersonate',
    ];

    /**
     * Fired when ready to build.
     *
     * @param Translator $translator
     */
    public function onReady(Translator $translator)
    {
        $user = $this->getUser();

        $this->setOption(
            'title',
            $translator->trans(
                'anomaly.module.users::message.impersonate',
                [
                    'display_name' => $user->getDisplayName(),
                ]
            )
        );

        $this->setOption(
            'description',
            implode(
                ' - ',
                [
                    $user->getUsername(),
                    $user->getEmail(),
                ]
            )
        );
    }

    /**
     * Get the user.
     *
     * @return UserInterface|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the user.
     *
     * @param UserInterface $user
     * @return $this
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }
}
