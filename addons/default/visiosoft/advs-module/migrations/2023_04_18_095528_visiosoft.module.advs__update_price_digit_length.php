<?php

use \Anomaly\Streams\Platform\Database\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class VisiosoftModuleAdvsUpdatePriceDigitLength extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advs_advs', function (Blueprint $table) {
            $table->decimal('price', 11, 4)->change();
            $table->decimal('standard_price', 11, 4)->change();
            $table->decimal('old_price', 11, 4)->change();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advs_advs', function (Blueprint $table) {
            $table->decimal('price', 11, 2)->change();
            $table->decimal('standard_price', 11, 2)->change();
            $table->decimal('old_price', 11, 2)->change();
        });
    }
}
