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
    	'category' => [
    		'type' => 'anomaly.field_type.select',
		    'config' => [
		    	'handler' => 'Visiosoft\AdvsModule\OptionHandler\CategoriesOptions@handle'
		    ]
	    ],
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
    	'category',
	    'name' => [
            'translatable' => true,
            'required' => true,
        ],
    ];
}
