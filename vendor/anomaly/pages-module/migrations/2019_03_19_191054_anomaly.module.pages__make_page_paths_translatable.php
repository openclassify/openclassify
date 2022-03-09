<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePagesMakePagePathsTranslatable
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePagesMakePagePathsTranslatable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $stream = $this->streams()->findBySlugAndNamespace('pages', 'pages');
        $field  = $this->fields()->findBySlugAndNamespace('path', 'pages');

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
        $field  = $this->fields()->findBySlugAndNamespace('path', 'pages');

        $assignment = $this->assignments()->findByStreamAndField($stream, $field);

        $this->assignments()->save($assignment->setAttribute('translatable', false));
    }
}
