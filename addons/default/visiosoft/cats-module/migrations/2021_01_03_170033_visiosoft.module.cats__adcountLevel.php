<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class VisiosoftModuleCatsAdcountLevel extends Migration
{

    public function up()
    {
        Schema::table('cats_category', function (Blueprint $table) {
            $table->integer('level');
            $table->datetime('level_at');
            $table->integer('count');
            $table->datetime('count_at');
        });
    }
}
