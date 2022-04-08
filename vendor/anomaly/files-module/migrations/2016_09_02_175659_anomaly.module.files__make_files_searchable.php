<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class AnomalyModuleFilesMakeFilesSearchable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->streams()->findBySlugAndNamespace('files', 'files')->setAttribute('searchable', true)->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->streams()->findBySlugAndNamespace('files', 'files')->setAttribute('searchable', false)->save();
    }
}
