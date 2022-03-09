<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class AnomalyModuleFilesMakeDisksSortable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->streams()->findBySlugAndNamespace('disks', 'files')->setAttribute('sortable', true)->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->streams()->findBySlugAndNamespace('disks', 'files')->setAttribute('sortable', false)->save();
    }
}
