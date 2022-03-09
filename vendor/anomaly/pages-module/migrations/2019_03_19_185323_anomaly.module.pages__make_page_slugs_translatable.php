<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePagesMakePageSlugsTranslatable
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePagesMakePageSlugsTranslatable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $stream = $this->streams()->findBySlugAndNamespace('pages', 'pages');
        $field  = $this->fields()->findBySlugAndNamespace('slug', 'pages');

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
        $stream = $this->streams()->findBySlugAndNamespace('pages', 'pages');
        $field  = $this->fields()->findBySlugAndNamespace('slug', 'pages');

        $assignment = $this->assignments()->findByStreamAndField($stream, $field);

        $this->assignments()->save($assignment->setAttribute('translatable', false));
    }
}
