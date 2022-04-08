<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleNavigationCreateNavigationFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleNavigationCreateNavigationFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'name'          => 'anomaly.field_type.text',
        'class'         => 'anomaly.field_type.text',
        'description'   => 'anomaly.field_type.textarea',
        'entry'         => 'anomaly.field_type.polymorphic',
        'slug'          => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'name',
            ],
        ],
        'menu'          => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\NavigationModule\Menu\MenuModel',
            ],
        ],
        'parent'        => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\NavigationModule\Link\LinkModel',
            ],
        ],
        'allowed_roles' => [
            'type'   => 'anomaly.field_type.multiple',
            'config' => [
                'related' => 'Anomaly\UsersModule\Role\RoleModel',
            ],
        ],
        'type'          => [
            'type'   => 'anomaly.field_type.addon',
            'config' => [
                'type'   => 'extension',
                'search' => 'anomaly.module.navigation::link_type.*',
            ],
        ],
        'target'        => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'default_value' => '_self',
                'options'       => [
                    '_self'  => 'anomaly.module.navigation::field.target.option.self',
                    '_blank' => 'anomaly.module.navigation::field.target.option.blank',
                ],
            ],
        ],
    ];

}
