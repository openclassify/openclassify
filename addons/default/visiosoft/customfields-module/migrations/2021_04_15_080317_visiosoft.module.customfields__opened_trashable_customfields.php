<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VisiosoftModuleCustomfieldsOpenedTrashableCustomfields extends Migration
{

    public function up()
    {
        if (!Schema::hasColumn('customfields_custom_fields', 'deleted_at')) {
            Schema::table('customfields_custom_fields', function (Blueprint $table) {
                $table->datetime('deleted_at')->nullable();
            });

            $this->streams()
                ->findBySlugAndNamespace('custom_fields', 'customfields')
                ->setAttribute('trashable', true)
                ->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('customfields_custom_fields', 'deleted_at')) {
            $this->streams()
                ->findBySlugAndNamespace('custom_fields', 'customfields')
                ->setAttribute('trashable', false)
                ->save();
        }

    }

}
