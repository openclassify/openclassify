<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Visiosoft\AdvsModule\Adv\AdvModel;

class VisiosoftModuleAdvsCreateProductoptionsStream extends Migration
{

    /**
     * This migration creates the stream.
     * It should be deleted on rollback.
     *
     * @var bool
     */
    protected $delete = true;

    protected $fields = [
    	'categories' => 'anomaly.field_type.select',
    ];
    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'productoptions',
        'title_column' => 'name',
        'translatable' => true,
        'versionable' => false,
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
    	'categories',
	    'name' => [
            'translatable' => true,
            'required' => true,
        ],
    ];
}
