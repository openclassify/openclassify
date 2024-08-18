<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCustomfieldsCreateParentStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'parent',
        'title_column' => 'cf_id',
        'translatable' => false,
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
        'cf_id' => [
            'required' => true,
        ],
        'cat_id' => [
            'required' => true,
        ],
    ];

}
