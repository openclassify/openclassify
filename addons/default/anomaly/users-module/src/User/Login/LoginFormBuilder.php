<?php namespace Anomaly\UsersModule\User\Login;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\UsersModule\User\UserSecurity;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LoginFormBuilder extends FormBuilder
{

    /**
     * No model.
     *
     * @var bool
     */
    protected $model = false;

    /**
     * The user instance. This is set
     * after a successful login
     * has validated.
     *
     * @var null|UserInterface
     */
    protected $user = null;

    /**
     * The form actions.
     *
     * @var array
     */
    protected $actions = [
        'blue' => [
            'text' => 'anomaly.module.users::button.login',
        ],
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'redirect'        => '/',
        'breadcrumb'      => false,
        'success_message' => false,
    ];

    /**
     * Fired when the form is posting.
     *
     * @param UserSecurity $security
     */
    public function onPost(UserSecurity $security)
    {
        $response = $security->attempt();

        if ($response instanceof Response) {

            $this->setFormResponse($response);

            $this->setSave(false);
        }
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
     * @param  UserInterface $user
     * @return $this
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }
}
