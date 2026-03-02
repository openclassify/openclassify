<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCatsAlterIndexToAllTable extends Migration
{
    public function up()
    {
        Schema::table('cats_category_translations', function (Blueprint $table) {
	        $table->index('entry_id');
        });
    }
}
