<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModulePostsMakePostSlugsTranslatable
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModulePostsMakePostSlugsTranslatable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $stream = $this->streams()->findBySlugAndNamespace('posts', 'posts');
        $field  = $this->fields()->findBySlugAndNamespace('slug', 'posts');

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
        $stream = $this->streams()->findBySlugAndNamespace('posts', 'posts');
        $field  = $this->fields()->findBySlugAndNamespace('slug', 'posts');

        $assignment = $this->assignments()->findByStreamAndField($stream, $field);

        $this->assignments()->save($assignment->setAttribute('translatable', false));
    }
}
