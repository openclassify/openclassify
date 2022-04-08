<?php namespace Anomaly\ContactPlugin\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ContactFormBuilder
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class ContactFormBuilder extends FormBuilder
{

    /**
     * The form handler.
     *
     * @var ContactFormHandler
     */
    protected $handler = ContactFormHandler::class;

    /**
     * The form fields.
     *
     * @var array
     */
    protected $fields = [
        'name'    => [
            'label'    => 'Name',
            'type'     => 'anomaly.field_type.text',
            'required' => true,
        ],
        'email'   => [
            'label'    => 'Email',
            'type'     => 'anomaly.field_type.email',
            'required' => true,
        ],
        'subject' => [
            'label'    => 'Subject',
            'type'     => 'anomaly.field_type.select',
            'required' => true,
            'config'   => [
                'options' => [
                    'Support',
                    'Sales',
                    'Feedback',
                    'Other',
                ],
            ],
        ],
        'message' => [
            'label'    => 'Message',
            'type'     => 'anomaly.field_type.textarea',
            'required' => true,
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
        'breadcrumb' => false,
    ];

}
