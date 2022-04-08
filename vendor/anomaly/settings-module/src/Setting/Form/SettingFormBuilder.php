<?php namespace Anomaly\SettingsModule\Setting\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class SettingFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SettingFormBuilder extends FormBuilder
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
    protected $fields = SettingFormFields::class;

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
