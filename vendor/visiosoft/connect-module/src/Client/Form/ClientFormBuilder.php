<?php namespace Visiosoft\ConnectModule\Client\Form;

use Visiosoft\ConnectModule\Client\ClientModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\UserModel;

/**
 * Class ClientFormBuilder
 *

 */
class ClientFormBuilder extends FormBuilder
{

    /**
     * The form model.
     *
     * @var ClientModel
     */
    protected $model = ClientModel::class;

    /**
     * The form sections.
     *
     * @var array
     */
    protected $sections = [
        'user'   => [
            'fields' => [
                'user_id',
            ],
        ],
        'client' => [
            'fields' => [
                'name',
                'redirect',
            ],
        ],
    ];


    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [
        'permission' => 'visiosoft.module.connect::clients.write',
        'redirect' => '/admin/connect'
    ];
}
