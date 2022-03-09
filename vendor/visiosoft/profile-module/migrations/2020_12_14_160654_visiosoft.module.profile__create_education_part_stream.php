<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Visiosoft\ProfileModule\Education\EducationModel;

class VisiosoftModuleProfileCreateEducationPartStream extends Migration
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
        'slug' => 'education_part',
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
	    'education' => [
		    'required' => true,
	    ],
        'name' => [
            'translatable' => true,
            'required' => true,
        ],
        'slug' => [
            'unique' => true,
            'required' => true,
        ],
    ];

    protected $fields = [
    	'education' => [
		    'type' => 'anomaly.field_type.relationship',
		    'config' => [
			    'related' => EducationModel::class,
		    ]
	    ]
    ];
}
