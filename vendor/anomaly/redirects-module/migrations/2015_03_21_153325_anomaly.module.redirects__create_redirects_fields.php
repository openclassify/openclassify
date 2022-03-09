<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleRedirectsCreateRedirectsFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleRedirectsCreateRedirectsFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'from'   => 'anomaly.field_type.text',
        'to'     => 'anomaly.field_type.text',
        'status' => [
            'type'   => 'anomaly.field_type.select',
            'config' => [
                'default_value' => '301',
                'options'       => [
                    '301' => 'anomaly.module.redirects::field.status.option.301',
                    '302' => 'anomaly.module.redirects::field.status.option.302',
                ],
            ],
        ],
        'secure' => 'anomaly.field_type.boolean',
    ];

}
