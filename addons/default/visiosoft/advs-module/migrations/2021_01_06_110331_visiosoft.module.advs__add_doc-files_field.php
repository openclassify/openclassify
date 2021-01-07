<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsAddDocFilesField extends Migration
{
	protected $delete = false;

	protected $stream = [
		'slug' => 'advs',
	];

	protected $fields = [
		'doc_files' => [
			'type' => 'visiosoft.field_type.media',
			'config' => [
				'folders' => ["ads_documents"],
				'mode' => 'upload',
			],
		],
	];

	protected $assignments = [
		'doc_files'
	];
}
