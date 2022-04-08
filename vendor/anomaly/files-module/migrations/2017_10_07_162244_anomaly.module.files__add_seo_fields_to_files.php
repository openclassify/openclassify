<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleFilesAddSeoFieldsToFiles
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleFilesAddSeoFieldsToFiles extends Migration
{

    /**
     * Don't delete the stream here
     * it's only for reference use.
     *
     * @var bool
     */
    protected $delete = false;

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'alt_text' => 'anomaly.field_type.text',
        'title'    => 'anomaly.field_type.text',
        'caption'  => 'anomaly.field_type.textarea',
    ];

    /**
     * The addon stream.
     * This is only for
     * reference for below.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'files',
    ];

    /**
     * The addon assignments.
     *
     * @var array
     */
    protected $assignments = [
        'alt_text'    => [
            'translatable' => true,
        ],
        'title'       => [
            'translatable' => true,
        ],
        'caption'     => [
            'translatable' => true,
        ],
        'description' => [
            'translatable' => true,
        ],
    ];
}
