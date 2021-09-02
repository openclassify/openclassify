<?php namespace Visiosoft\ClassifiedsModule\Classified\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\UserModel;
use Visiosoft\ClassifiedsModule\Classified\ClassifiedModel;

class SimpleClassifiedFormBuilder extends FormBuilder
{
    protected $model = ClassifiedModel::class;
  
    protected $assets = [
        'scripts.js' => [
            'visiosoft.module.classifieds::js/simple.js'
        ],
        'styles.css' => [
            'visiosoft.module.classifieds::css/simple.scss'
        ],
    ];

    protected $options = [
        'wrapper_view' => 'visiosoft.module.classifieds::blank'
    ];

    protected $buttons = [
        'cancel',
    ];
}
