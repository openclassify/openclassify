<?php

use Anomaly\BlocksModule\Block\Support\SelectFieldType\CategoryOptions;
use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleBlocksCreateTypesFields
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleBlocksCreateTypesFields extends Migration
{

    /**
     * The fields array.
     *
     * @var array
     */
    protected $fields = [
        'category'       => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'handler' => CategoryOptions::class,
            ],
        ],
        'content_layout' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'          => 'twig',
                'default_value' => '<p>{{ block.field_slug }}</p>',
            ],
        ],
        'wrapper_layout' => [
            'type'   => 'anomaly.field_type.editor',
            'config' => [
                'mode'          => 'twig',
                'default_value' => '{% extends "anomaly.module.blocks::types.wrapper" %}',
            ],
        ],
    ];
}
