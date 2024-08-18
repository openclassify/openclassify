<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCommentsCreateCommentsStream extends Migration
{

    /**
     * This migration creates the stream.
     * It should be deleted on rollback.
     *
     * @var bool
     */
    protected $delete = true;

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'comments',
        'title_column' => 'username',
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
        'entry',
        'username',
        'title',
        'detail',
        'rating',
        'status'
    ];

}
