<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCustomfieldsMakeCfvalueSortable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->streams()
            ->findBySlugAndNamespace('cfvalue', 'customfields')
            ->setAttribute('sortable', true)
            ->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->streams()
            ->findBySlugAndNamespace('cfvalue', 'customfields')
            ->setAttribute('sortable', false)
            ->save();
    }
}

