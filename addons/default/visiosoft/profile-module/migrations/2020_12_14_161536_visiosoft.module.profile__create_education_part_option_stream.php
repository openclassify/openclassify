<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use \Visiosoft\ProfileModule\EducationPart\EducationPartModel;

class VisiosoftModuleProfileCreateEducationPartOptionStream extends Migration
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
        'slug' => 'education_part_option',
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
	    'education_part' => [
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
		'education_part' => [
			'type' => 'anomaly.field_type.relationship',
			'config' => [
				'related' => EducationPartModel::class,
			]
		]
	];

}
