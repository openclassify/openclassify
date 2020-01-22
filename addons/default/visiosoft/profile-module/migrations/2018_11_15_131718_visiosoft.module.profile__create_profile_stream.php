<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleProfileCreateProfileStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'profile',
         'title_column' => 'id',
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
        'user',
        'file',
        'email' => [
            'required' => true
        ],
        'image',
        'country',
        'city',
        'district',
        'neighborhood',
        'village',
        'gsm_phone',
        'land_phone','office_phone','register_type',
        'identification_number',
        'notified_new_updates',
        'notified_about_ads',
        'receive_messages_email',
        'adv_listing_banner'
    ];

}
