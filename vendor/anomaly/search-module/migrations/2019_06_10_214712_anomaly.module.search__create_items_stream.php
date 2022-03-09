<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

/**
 * Class AnomalyModuleSearchCreateItemsStream
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AnomalyModuleSearchCreateItemsStream extends Migration
{

    /**
     * This migration creates the stream.
     * It should be deleted on rollback.
     *
     * @var bool
     */
    protected $delete = true;

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'items',
        'title_column' => 'title',
        'translatable' => false,
        'versionable'  => false,
        'trashable'    => false,
        'searchable'   => false,
        'sortable'     => false,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'title',
        'description',
        'keywords',
        'entry'  => [
            'required' => true,
        ],
        'stream' => [
            'required' => true,
        ],
        'locale' => [
            'required' => true,
        ],
        'searchable',
    ];

    /**
     * Migrate up.
     */
    public function up()
    {
        app('db')->statement('ALTER TABLE ' . app('db')->getTablePrefix() . 'search_items ADD FULLTEXT(title,description);');
        app('db')->statement('ALTER TABLE ' . app('db')->getTablePrefix() . 'search_items ADD FULLTEXT(searchable);');
    }

}
