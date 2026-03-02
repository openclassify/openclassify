<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateAdNoteField extends Migration
{

    protected $stream = [
        'slug' => 'advs',
        'title_column' => 'ad_note',
        'translatable' => true,
    ];

    protected $fields = [
        'ad_note' => [
            'type' => 'anomaly.field_type.textarea',
            'config' => [
                'required' => false,
                'translatable' => true,
            ]
        ],
    ];

    protected $assignments = [
        'ad_note'
    ];

}
