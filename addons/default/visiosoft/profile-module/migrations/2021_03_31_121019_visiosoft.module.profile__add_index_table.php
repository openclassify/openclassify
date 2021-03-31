<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleProfileAddIndexTable extends Migration
{
    public function up()
    {
	    Schema::table('files_files', function (Blueprint $table) {
		    $table->index('deleted_at');
		    $table->index('name');
		    $table->index('folder_id');
	    });

	    Schema::table('page_link_type_pages_translations', function (Blueprint $table) {
		    $table->index('entry_id');
		    $table->index('locale');
	    });
    }
}
