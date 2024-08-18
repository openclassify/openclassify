<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCustomfieldsDeleteCustomFieldAdv extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ($stream = $this->streams()->findBySlugAndNamespace('custom_field_advs', 'customfields')) {
            $stream->delete();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
