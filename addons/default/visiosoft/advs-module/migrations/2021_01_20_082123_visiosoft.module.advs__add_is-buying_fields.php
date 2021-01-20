<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsAddIsBuyingFields extends Migration
{
	protected $delete = false;

	protected $stream = [
		'slug' => 'advs',
	];

	protected $fields = [
		'is_buying' => [
			'type' => 'anomaly.field_type.boolean',
			'config' => [
				'default' => false,
			]
		],
	];

	protected $assignments = [
		'is_buying'
	];
}
