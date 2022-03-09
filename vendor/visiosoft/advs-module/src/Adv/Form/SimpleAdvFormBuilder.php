<?php namespace Visiosoft\AdvsModule\Adv\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\UserModel;
use Visiosoft\AdvsModule\Adv\AdvModel;

class SimpleAdvFormBuilder extends FormBuilder
{
    protected $model = AdvModel::class;
  
    protected $assets = [
        'scripts.js' => [
            'visiosoft.module.advs::js/simple.js'
        ],
        'styles.css' => [
            'visiosoft.module.advs::css/simple.scss'
        ],
    ];

    protected $options = [
        'wrapper_view' => 'visiosoft.module.advs::blank'
    ];

    protected $buttons = [
        'cancel',
    ];
}
