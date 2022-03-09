<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleNotificationsCreateNotificationsFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'name' => 'anomaly.field_type.text',
        'greeting' => 'anomaly.field_type.text',
        'subject' => 'anomaly.field_type.text',
        'message' => [
            'type' => 'anomaly.field_type.wysiwyg',
            'config' => [
                'height' => 500,
            ],
        ],
        'slug' => [
            'type' => 'anomaly.field_type.slug',
            'config' => [
                'slugify' => 'name',
                'type' => '_'
            ],
        ],
    ];

}
