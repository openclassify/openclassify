<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCustomfieldsAddIndexTable extends Migration
{
    public function up()
    {
	    Schema::table('customfields_parent', function (Blueprint $table) {
		    $table->index('cf_id');
		    $table->index('cat_id');
	    });

        Schema::table('customfields_cfvalue', function (Blueprint $table) {
		    $table->index('custom_field_id');
	    });
    }
}
