<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateOptionConfigurationStream extends Migration
{

    /**
     * This migration creates the stream.
     * It should be deleted on rollback.
     *
     * @var bool
     */
    protected $delete = true;

    protected $fields = [
    	'option_json' => 'visiosoft.field_type.json',
    ];

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'option_configuration',
        'title_column' => 'option_json',
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
	    'parent_adv' => [
	    	'required' => true,
	    ],
	    'price' => [
	    	'required' => true,
	    ],
	    'currency' => [
	    	'required' => true,
	    ],
	    'stock' => [
	    	'required' => true,
	    ],
	    'option_json' => [
	    	'required' => true,
	    ],
    ];

}
