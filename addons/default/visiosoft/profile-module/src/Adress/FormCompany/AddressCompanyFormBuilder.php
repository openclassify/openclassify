<?php namespace Visiosoft\ProfileModule\Adress\FormCompany;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Visiosoft\ProfileModule\Adress\AdressModel;

class AddressCompanyFormBuilder extends FormBuilder
{

    /**
     * Additional validation rules.
     *
     * @var array|string
     */
    protected $model = AdressModel::class;

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
    protected $options = [
        'redirect' => '/profile/address',
        'success_message' => 'visiosoft.module.profile::message.adress_success_create',
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
