<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class AnomalyModulePagesMakePagesSearchable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->streams()->findBySlugAndNamespace('pages', 'pages')->setAttribute('searchable', true)->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->streams()->findBySlugAndNamespace('pages', 'pages')->setAttribute('searchable', false)->save();
    }
}
