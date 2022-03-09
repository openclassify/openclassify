<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleProfileAddIndexTable extends Migration
{
    public function up()
    {
        // it broke installation
        //	    Schema::table('files_files', function (Blueprint $table) {
        //		    $table->index('deleted_at');
        //		    $table->index('name');
        //		    $table->index('folder_id');
        //	    });

    }
}
