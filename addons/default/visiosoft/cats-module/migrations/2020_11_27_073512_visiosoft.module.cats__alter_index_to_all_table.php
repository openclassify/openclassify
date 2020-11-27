<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCatsAlterIndexToAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cats_category_translations', function (Blueprint $table) {
	        $table->index('entry_id');
        });

        Schema::table('cats_placeholderforsearch_translations', function (Blueprint $table) {
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
        Schema::table('cats_category_translations', function (Blueprint $table) {
	        $table->index('entry_id');
        });

	    Schema::table('cats_placeholderforsearch_translations', function (Blueprint $table) {
		    $table->index('entry_id');
	    });
    }
}
