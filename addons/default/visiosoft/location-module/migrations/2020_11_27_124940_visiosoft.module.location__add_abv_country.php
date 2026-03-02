<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleLocationAddAbvCountry extends Migration
{

	protected $delete = false;

	protected $stream = [
		'slug' => 'countries',
	];

	protected $fields = [
		'abv' =>  'anomaly.field_type.text',
	];

	protected $assignments = [
		'abv',
	];
}
