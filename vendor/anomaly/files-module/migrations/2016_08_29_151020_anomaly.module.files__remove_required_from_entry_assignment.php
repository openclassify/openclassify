<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class AnomalyModuleFilesRemoveRequiredFromEntryAssignment extends Migration
{

    /**
     * Run the migration.
     */
    public function up()
    {
        $assignment = $this->assignments()->findByStreamAndField(
            $this->streams()->findBySlugAndNamespace('files', 'files'),
            $this->fields()->findBySlugAndNamespace('entry', 'files')
        );

        $assignment->setAttribute('required', false);

        $this->assignments()->save($assignment);
    }
}
