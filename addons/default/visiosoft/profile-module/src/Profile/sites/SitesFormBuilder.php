<?php namespace Visiosoft\ProfileModule\Profile\sites;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Rinvex\Subscriptions\Models\Plan;
use Visiosoft\CloudsiteModule\Site\SiteModel;

class SitesFormBuilder extends FormBuilder
{

    protected $model = SiteModel::class;

    /**
     * The form fields.
     *
     * @var array|string
     */

    protected $fields = [
        'subdomain'
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
    protected $actions = [
        'save' => [
            'text' => 'visiosoft.module.subscriptions::button.create',
        ],
    ];

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
    protected $options = [
        'redirect' => '/admin/subscriptions/',
    ];

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
