<?php

use Anomaly\DashboardModule\Dashboard\DashboardModel;
use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\UsersModule\Role\RoleModel;

/**
 * Class AnomalyModuleDashboardCreateDashboardFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleDashboardCreateDashboardFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'name'          => 'anomaly.field_type.text',
        'slug'          => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'name',
            ],
        ],
        'description'   => 'anomaly.field_type.textarea',
        'layout'        => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'options' => [
                    '24'      => 'anomaly.module.dashboard::field.layout.option.24',
                    '12-12'   => 'anomaly.module.dashboard::field.layout.option.12-12',
                    '16-8'    => 'anomaly.module.dashboard::field.layout.option.16-8',
                    '8-16'    => 'anomaly.module.dashboard::field.layout.option.8-16',
                    '8-8-8'   => 'anomaly.module.dashboard::field.layout.option.8-8-8',
                    '6-12-6'  => 'anomaly.module.dashboard::field.layout.option.6-12-6',
                    '12-6-6'  => 'anomaly.module.dashboard::field.layout.option.12-6-6',
                    '6-6-12'  => 'anomaly.module.dashboard::field.layout.option.6-6-12',
                    '6-6-6-6' => 'anomaly.module.dashboard::field.layout.option.6-6-6-6',
                ],
            ],
        ],
        'title'         => 'anomaly.field_type.text',
        'extension'     => [
            'type'   => 'anomaly.field_type.addon',
            'config' => [
                'type'   => 'extension',
                'search' => 'anomaly.module.dashboard::widget.*',
            ],
        ],
        'column'        => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'min'           => 1,
                'default_value' => 1,
            ],
        ],
        'pinned'        => 'anomaly.field_type.boolean',
        'dashboard'     => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => DashboardModel::class,
            ],
        ],
        'allowed_roles' => [
            'type'   => 'anomaly.field_type.multiple',
            'config' => [
                'related' => RoleModel::class,
            ],
        ],
    ];

}
