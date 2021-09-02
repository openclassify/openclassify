<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleClassifiedsAddDocFilesField extends Migration
{
	protected $delete = false;

	protected $stream = [
		'slug' => 'classifieds',
	];

	protected $fields = [
		'doc_files' => [
			'type' => 'visiosoft.field_type.media',
			'config' => [
				'folders' => ["classifieds_documents"],
				'mode' => 'upload',
			],
		],
	];

	protected $assignments = [
		'doc_files'
	];
}
