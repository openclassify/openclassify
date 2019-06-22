<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateCfValuesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'cf_values',
         'title_column' => 'value',
         'translatable' => true,
         'versionable' => false,
         'trashable' => false,
         'searchable' => false,
         'sortable' => false,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'custom_field',
        'value' => [
            'translatable' => true
        ]
    ];
}
