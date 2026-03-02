<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use \Visiosoft\AdvsModule\Productoption\ProductoptionModel;

class VisiosoftModuleAdvsCreateProductoptionsValueStream extends Migration
{

    /**
     * This migration creates the stream.
     * It should be deleted on rollback.
     *
     * @var bool
     */
    protected $delete = true;


    protected $fields = [
    	'product_option' => [
    		'type' => 'anomaly.field_type.relationship',
		    'config' => [
			    'related' => ProductoptionModel::class,
		    ],
	    ]
    ];

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'productoptions_value',
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
    	'name' => [
    		'translatable' => true,
		    'required' => true,
	    ],
		'product_option' => [
			'required' => true,
		],
    ];
}
