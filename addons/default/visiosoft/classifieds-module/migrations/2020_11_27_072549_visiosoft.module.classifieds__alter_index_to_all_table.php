<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleClassifiedsAlterIndexToAllTable extends Migration
{
	public function up()
	{
        Schema::table('classifieds_productoptions_value_translations', function (Blueprint $table) {
            $table->index('entry_id');
        });

		Schema::table('classifieds_classifieds_translations', function (Blueprint $table) {
			$table->index('entry_id');
		});

		Schema::table('classifieds_productoptions_translations', function (Blueprint $table) {
			$table->index('entry_id');
		});
	}
}
