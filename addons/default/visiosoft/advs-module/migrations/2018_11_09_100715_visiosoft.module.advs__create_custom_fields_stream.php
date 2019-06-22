<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateCustomFieldsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'custom_fields',
         'title_column' => 'name',
         'translatable' => true,
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
        'parent_category',
        'type',
        'name' => [
            'translatable' => true,
            'required' => true,
        ],
        'slug' => [
            'unique' => true,
            'required' => true,
        ],
        'custom_field_select_options',
        'description',
    ];

}
