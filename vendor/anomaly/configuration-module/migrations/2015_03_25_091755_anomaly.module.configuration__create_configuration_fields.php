<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleConfigurationCreateConfigurationFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleConfigurationCreateConfigurationFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'scope' => 'anomaly.field_type.text',
        'key'   => 'anomaly.field_type.text',
        'value' => 'anomaly.field_type.textarea',
    ];

}
