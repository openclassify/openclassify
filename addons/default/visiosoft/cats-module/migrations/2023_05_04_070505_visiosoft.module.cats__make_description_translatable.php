<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCatsMakeDescriptionTranslatable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $stream = $this->streams()->findBySlugAndNamespace('category', 'cats');
        $field  = $this->fields()->findBySlugAndNamespace('description', 'cats');
        $assignment = $this->assignments()->findByStreamAndField($stream, $field);
        $this->assignments()->save($assignment->setAttribute('translatable', true));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $stream = $this->streams()->findBySlugAndNamespace('category', 'cats');
        $field  = $this->fields()->findBySlugAndNamespace('description', 'cats');
        $assignment = $this->assignments()->findByStreamAndField($stream, $field);

        $this->assignments()->save($assignment->setAttribute('translatable', false));
    }
}
