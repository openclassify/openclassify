<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleLocationAlterIndexToAllTable extends Migration
{
    public function up()
    {
        Schema::table('location_cities_translations', function (Blueprint $table) {
	        $table->index('entry_id');
        });

	    Schema::table('location_countries_translations', function (Blueprint $table) {
		    $table->index('entry_id');
	    });

	    Schema::table('location_districts_translations', function (Blueprint $table) {
		    $table->index('entry_id');
	    });

	    Schema::table('location_neighborhoods_translations', function (Blueprint $table) {
		    $table->index('entry_id');
	    });

	    Schema::table('location_village_translations', function (Blueprint $table) {
		    $table->index('entry_id');
	    });
    }
}
