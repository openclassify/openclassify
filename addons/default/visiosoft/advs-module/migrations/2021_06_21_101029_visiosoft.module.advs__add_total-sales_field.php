<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsAddTotalSalesField extends Migration
{
	protected $delete = false;

	protected $stream = [
		'slug' => 'advs',
	];

	protected $fields = [
		'total_sales' => [
			'type' => 'anomaly.field_type.integer',
			'config' => [
				'min' => 0,
				'default_value' => 0,
			],
		],
	];

	protected $assignments = [
		'total_sales'
	];
}
