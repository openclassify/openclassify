<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCustomfieldsCreateCustomFieldsStream extends Migration
{

    protected $stream = [
        'slug' => 'custom_fields',
        'title_column' => 'name',
        'translatable' => true,
        'trashable' => false,
        'searchable' => false,
        'sortable' => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name' => [
            'translatable' => true,
            'required' => true,
        ],
        'slug' => [
            'unique' => true,
            'required' => true,
        ],
        'parent_category' => [
            'required' => false,
        ],
        'type' => [
            'required' => true,
        ],
        // 'custom_field_select_options' => [
        //     'translatable' => true,
        // ],
        'description' => [
            'translatable' => true,
        ],
        'seenList'
    ];

}
