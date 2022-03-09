<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class AnomalyModulePostsMakePostsSearchable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->streams()->findBySlugAndNamespace('posts', 'posts')->setAttribute('searchable', true)->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->streams()->findBySlugAndNamespace('posts', 'posts')->setAttribute('searchable', false)->save();
    }
}
