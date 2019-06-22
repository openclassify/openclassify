<?php namespace Visiosoft\ProfileModule\Profile\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\Validation\ValidateEmail;

class ProfileFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array|string
     */
    protected $fields = [
        'email'     => [
            'instructions' => false,
            'rules'        => [
                'valid_email',
            ],
            'validators'   => [
                'valid_email' => [
                    'message' => false,
                    'handler' => ValidateEmail::class,
                ],
            ],
        ],
    ];

    /**
     * Additional validation rules.
     *
     * @var array|string
     */
    protected $rules = [];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [];

    /**
     * The form buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'cancel',
    ];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [];

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [];

}
