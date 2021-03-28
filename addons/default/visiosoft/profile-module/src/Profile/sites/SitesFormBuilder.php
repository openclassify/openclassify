<?php namespace Visiosoft\ProfileModule\Profile\sites;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Visiosoft\CloudsiteModule\Site\SiteModel;

class SitesFormBuilder extends FormBuilder
{
    protected $model = SiteModel::class;

    protected $fields = [
        'subdomain'
    ];

    protected $actions = [
        'save' => [
            'text' => 'visiosoft.module.subscriptions::button.create',
        ],
    ];

    protected $buttons = [
        'cancel',
    ];

    protected $options = [
        'redirect' => '/admin/subscriptions/',
    ];
}
