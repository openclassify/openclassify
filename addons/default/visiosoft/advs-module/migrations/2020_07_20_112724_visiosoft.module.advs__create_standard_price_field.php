<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsCreateStandardPriceField extends Migration
{

    /**
     * Don't delete stream on rollback
     * because this isn't creating the
     * stream only referencing it.
     */
    protected $delete = false;

    /**
     * Any additional information will
     * be updated. Slug helps find
     * the stream to work with for
     * assignments that follow.
     */
    protected $stream = [
        'slug' => 'advs',
    ];

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'standard_price' => [
            'type' => 'visiosoft.field_type.decimal',
            'config' => [
                'decimal' => 2,
                'separator' => '.',
                'point' => ','
            ],
        ],
    ];

    /**
     * The field's assignment.
     *
     * @var array
     */
    protected $assignments = [
        'standard_price' => [
            'required' => true
        ],
    ];

}
