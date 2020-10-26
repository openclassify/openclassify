<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleLocationAddAbvToCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('location_countries_translations', function (Blueprint $table) {
	        $table->string('abv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('location_countries_translations', function (Blueprint $table) {
	        $table->string('abv');
        });
    }
}
