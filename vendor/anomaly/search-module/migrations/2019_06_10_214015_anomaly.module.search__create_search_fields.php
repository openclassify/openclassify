<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleSearchCreateSearchFields
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleSearchCreateSearchFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'title'       => 'anomaly.field_type.text',
        'locale'      => 'anomaly.field_type.text',
        'description' => 'anomaly.field_type.textarea',
        'entry'       => 'anomaly.field_type.polymorphic',
        'stream'      => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'mode'    => 'search',
                'related' => \Anomaly\Streams\Platform\Stream\StreamModel::class,
            ],
        ],
        'keywords'    => [
            'type'   => 'anomaly.field_type.textarea',
            'config' => [
                'storage' => 'json',
            ],
        ],
        'searchable'  => [
            'type'   => 'anomaly.field_type.textarea',
            'config' => [
                'storage' => 'json',
            ],
        ],
    ];

}
