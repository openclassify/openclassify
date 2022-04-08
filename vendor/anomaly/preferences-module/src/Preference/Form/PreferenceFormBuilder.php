<?php namespace Anomaly\PreferencesModule\Preference\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class PreferenceFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PreferenceFormBuilder extends FormBuilder
{

    /**
     * No model needed.
     *
     * @var bool
     */
    protected $model = false;

    /**
     * The form fields handler.
     *
     * @var string
     */
    protected $fields = PreferenceFormFields::class;

    /**
     * The form actions.
     *
     * @var array
     */
    protected $actions = [
        'update',
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
