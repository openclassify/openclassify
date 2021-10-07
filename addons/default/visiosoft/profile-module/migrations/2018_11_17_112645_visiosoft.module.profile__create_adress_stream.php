<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleProfileCreateAdressStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'adress',
        'title_column' => 'id',
        'translatable' => false,
        'trashable' => true,
        'searchable' => false,
        'sortable' => false,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'user',
        'adress_name' => [
            'required' => true,
        ],
        'adress_first_name' => [
            'required' => true,
        ],
        'adress_last_name' => [
            'required' => true,
        ],
        'country' => [
            'required' => true,
        ],
        'city' => [
            'required' => false,
        ],
        'district',
        'adress_content' => [
            'required' => true,
        ],
        'adress_gsm_phone' => [
            'required' => true,
        ],
        'company',
        'tax_number',
        'tax_office',
        'is_company',
    ];

}
