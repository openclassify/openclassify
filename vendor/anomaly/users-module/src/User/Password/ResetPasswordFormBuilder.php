<?php namespace Anomaly\UsersModule\User\Password;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ResetPasswordFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ResetPasswordFormBuilder extends FormBuilder
{

    /**
     * The reset code.
     *
     * @var null|string
     */
    protected $code = null;

    /**
     * The user email.
     *
     * @var null|string
     */
    protected $email = null;

    /**
     * No model.
     *
     * @var bool
     */
    protected $model = false;

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
        'redirect' => '/',
    ];

    /**
     * Get the email.
     *
     * @return null|string
     */
    public function getEmail()
    {
        return $this->getFormValue('email', $this->email);
    }

    /**
     * Set the email.
     *
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the code.
     *
     * @return null|string
     */
    public function getCode()
    {
        return $this->getFormValue('code', $this->code);
    }

    /**
     * Set the code.
     *
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }
}
