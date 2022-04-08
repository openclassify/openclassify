<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleBlocksCreateBlocksFields
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class AnomalyModuleBlocksCreateBlocksFields extends Migration
{

    /**
     * The fields array.
     *
     * @var array
     */
    protected $fields = [
        'name'        => 'anomaly.field_type.text',
        'description' => 'anomaly.field_type.textarea',
        'slug'        => [
            'type'   => 'anomaly.field_type.slug',
            'config' => [
                'type'    => '-',
                'slugify' => 'name',
            ],
        ],
        'title'       => 'anomaly.field_type.text',
        'field'       => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'mode'    => 'lookup',
                'related' => 'Anomaly\Streams\Platform\Field\FieldModel',
            ],
        ],
        'area'        => 'anomaly.field_type.polymorphic',
        'entry'       => 'anomaly.field_type.polymorphic',
        'blocks'      => 'anomaly.field_type.blocks',
        'extension'   => [
            'type'   => 'anomaly.field_type.addon',
            'config' => [
                'type'   => 'extensions',
                'search' => 'anomaly.module.blocks::block.*',
            ],
        ],
    ];

}
