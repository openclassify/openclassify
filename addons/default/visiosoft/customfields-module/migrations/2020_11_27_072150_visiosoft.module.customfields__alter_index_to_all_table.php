<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCustomfieldsAlterIndexToAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	    Schema::table('customfields_custom_fields_translations', function (Blueprint $table) {
		    $table->index('entry_id');
	    });

	    Schema::table('customfields_cfvalue_translations', function (Blueprint $table) {
		    $table->index('entry_id');
	    });
    }
}
