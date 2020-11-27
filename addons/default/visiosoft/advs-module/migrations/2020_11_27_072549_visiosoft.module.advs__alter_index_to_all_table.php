<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsAlterIndexToAllTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('advs_productoptions_translations', function (Blueprint $table) {
			$table->index('entry_id');
		});

		Schema::table('advs_productoptions_value_translations', function (Blueprint $table) {
			$table->index('entry_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('advs_productoptions_translations', function (Blueprint $table) {
			$table->index('entry_id');
		});

		Schema::table('advs_productoptions_value_translations', function (Blueprint $table) {
			$table->index('entry_id');
		});
	}
}
