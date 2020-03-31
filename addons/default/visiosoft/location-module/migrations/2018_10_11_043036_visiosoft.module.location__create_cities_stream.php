<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleLocationCreateCitiesStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'cities',
         'title_column' => 'name',
         'translatable' => true,
         'trashable' => true,
         'searchable' => false,
         'sortable' => false,
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
        'parent_country_id' => [
            'required' => true,
        ],
        'order'
    ];

}
