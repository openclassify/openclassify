<?php

use Anomaly\PostsModule\Category\CategoryModel;
use Anomaly\PostsModule\Type\TypeModel;
use Anomaly\SelectFieldType\Handler\Layouts;
use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\UsersModule\User\UserModel;

/**
 * Class AnomalyModulePostsCreatePostsFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePostsCreatePostsFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'str_id'           => 'anomaly.field_type.text',
        'name'             => 'anomaly.field_type.text',
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
            'locked' => 0, // This means, field would be visible in CP
        ],
        'type'             => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => TypeModel::class,
            ],
        ],
        'tags'             => 'anomaly.field_type.tags',
        'summary'          => 'anomaly.field_type.textarea',
        'description'      => 'anomaly.field_type.textarea',
        'publish_at'       => 'anomaly.field_type.datetime',
        'entry'            => 'anomaly.field_type.polymorphic',
        'author'           => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'mode'    => 'lookup',
                'related' => UserModel::class,
            ],
        ],
        'layout'           => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'default_value' => '{{ post.content|raw }}',
                'mode'          => 'twig',
            ],
        ],
        'category'         => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => CategoryModel::class,
            ],
        ],
        'enabled'          => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => false,
            ],
        ],
        'featured'         => [
            'type'   => 'anomaly.field_type.boolean',
            'config' => [
                'default_value' => false,
            ],
        ],
        'meta_title'       => 'anomaly.field_type.text',
        'meta_description' => 'anomaly.field_type.textarea',
        'meta_keywords'    => 'anomaly.field_type.tags', // Removed in 2.3
        'ttl'              => [
            'type'   => 'anomaly.field_type.integer',
            'config' => [
                'min'  => 0,
                'step' => 1,
                'page' => 5,
            ],
        ],
        'theme_layout'     => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'mode'    => 'search',
                'handler' => Layouts::class,
            ],
        ],
    ];
}
