<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VisiosoftModuleProfileEducationSortable extends Migration
{
    public function up()
    {
        $this->streams()
            ->findBySlugAndNamespace('education', 'profile')
            ->setAttribute('sortable', true)
            ->save();
    }

    public function down()
    {
        $this->streams()
            ->findBySlugAndNamespace('education', 'profile')
            ->setAttribute('sortable', false)
            ->save();
    }
}
