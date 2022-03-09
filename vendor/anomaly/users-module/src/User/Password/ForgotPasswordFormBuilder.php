<?php namespace Anomaly\UsersModule\User\Password;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ForgotPasswordFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ForgotPasswordFormBuilder extends FormBuilder
{

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
        'redirect'        => '/',
        'success_message' => 'anomaly.module.users::message.confirm_reset_password',
    ];
}
