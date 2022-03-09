<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyExtensionUrlLinkTypeCreateUrlLinkTypeFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyExtensionUrlLinkTypeCreateUrlLinkTypeFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'title'       => 'anomaly.field_type.text',
        'url'         => 'anomaly.field_type.text',
        'description' => 'anomaly.field_type.textarea',
    ];

}
