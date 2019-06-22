<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCatsCreatePlaceholderforsearchStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'placeholderforsearch',
        'title_column' => 'name',
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
        'name' => [
            'translatable' => true,
            'required' => true,
        ],
    ];

}
