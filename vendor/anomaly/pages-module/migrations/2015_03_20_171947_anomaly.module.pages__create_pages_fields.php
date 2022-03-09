<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePagesCreatePagesFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePagesCreatePagesFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'str_id'           => 'anomaly.field_type.text',
        'title'            => 'anomaly.field_type.text',
        'slug'             => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'title',
                'type'    => '-',
            ],
        ],
        'content'          => [
            'type'   => 'anomaly.field_type.wysiwyg',
            'locked' => 0, // Used with seeded pages.
        ],
        'path'             => 'anomaly.field_type.text',
        'enabled'          => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
            ],
        ],
        'home'             => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => false,
            ],
        ],
        'meta_title'       => 'anomaly.field_type.text',
        'meta_description' => 'anomaly.field_type.textarea',
        'meta_keywords'    => 'anomaly.field_type.tags',
        'layout'           => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'default_value' => '<h1>{{ page.title }}</h1>',
                'mode'          => 'twig',
            ],
        ],
        'allowed_roles'    => [
            'type'   => 'anomaly.field_type.multiple',
            'config' => [
                'related' => 'Anomaly\UsersModule\Role\RoleModel',
            ],
        ],
        'parent'           => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'mode'    => 'lookup',
                'related' => 'Anomaly\PagesModule\Page\PageModel',
            ],
        ],
        'theme_layout'     => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'default_value' => 'theme::layouts/default.twig',
                'handler'       => 'Anomaly\SelectFieldType\Handler\Layouts@handle',
            ],
        ],
        'type'             => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => 'Anomaly\PagesModule\Type\TypeModel',
            ],
        ],
        'handler'          => [
            'type'   => 'anomaly.field_type.addon',
            'config' => [
                'type'          => 'extension',
                'search'        => 'anomaly.module.pages::handler.*',
                'default_value' => 'anomaly.extension.default_page_handler',
            ],
        ],
        'visible'          => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
            ],
        ],
        'exact'            => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => true,
            ],
        ],
        'entry'            => 'anomaly.field_type.polymorphic',
        'name'             => 'anomaly.field_type.text',
        'description'      => 'anomaly.field_type.textarea',
    ];

}
