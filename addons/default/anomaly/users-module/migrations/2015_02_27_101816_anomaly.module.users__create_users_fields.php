<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\UsersModule\Role\RoleModel;

/**
 * Class AnomalyModuleUsersCreateUsersFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleUsersCreateUsersFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'email'                      => 'anomaly.field_type.email',
        'username'                   => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'type'      => '_',
                'lowercase' => false,
            ],
        ],
        'password'                   => [
            'type'   => 'anomaly.field_type.text',
            'config' => [
                'type' => 'password',
            ],
        ],
        'remember_token'             => 'anomaly.field_type.text',
        'ip_address'                 => 'anomaly.field_type.text',
        'last_login_at'              => 'anomaly.field_type.datetime',
        'last_activity_at'           => 'anomaly.field_type.datetime',
        'permissions'                => 'anomaly.field_type.checkboxes',
        'display_name'               => 'anomaly.field_type.text',
        'first_name'                 => 'anomaly.field_type.text',
        'last_name'                  => 'anomaly.field_type.text',
        'name'                       => 'anomaly.field_type.text',
        'description'                => 'anomaly.field_type.textarea',
        'reset_code'                 => 'anomaly.field_type.text',
        'reset_code_expires_at'      => 'anomaly.field_type.datetime',
        'activation_code'            => 'anomaly.field_type.text',
        'activation_code_expires_at' => 'anomaly.field_type.datetime',
        'activated'                  => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => false,
            ],
        ],
        'enabled'                    => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
            ],
        ],
        'slug'                       => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'name',
            ],
        ],
        'roles'                      => [
            'type'   => 'anomaly.field_type.multiple',
            'config' => [
                'related' => RoleModel::class,
            ],
        ],
    ];

}
