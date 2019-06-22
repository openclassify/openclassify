<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateCustomFieldAdvsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'custom_field_advs',
         'translatable' => true,
         'trashable' => false,
         'searchable' => false,
         'sortable' => false,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'parent_adv',
        'custom_field_category',
        'custom_field_value',
        'custom_field_type'
    ];

}
