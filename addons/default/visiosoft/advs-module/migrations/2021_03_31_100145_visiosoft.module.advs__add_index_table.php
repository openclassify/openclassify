<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsAddIndexTable extends Migration
{
	public function up()
	{
		Schema::table('advs_advs', function (Blueprint $table) {
			$table->index('deleted_at');
			$table->index('cat1');
			$table->index('country_id');
			$table->index('city');
			$table->index('finish_at');
			$table->index('status');
			$table->index('count_show_ad');
		});
	}
}
