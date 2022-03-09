<?php namespace Anomaly\FilesModule\File\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class FileTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array
     */
    protected $views = [
        'all',
        'recently_created' => [
            'text'    => 'streams::view.newest',
            'columns' => [
                'entry.preview'             => [
                    'heading' => 'anomaly.module.files::field.preview.name',
                ],
                'name'                      => [
                    'sort_column' => 'name',
                    'wrapper'     => '
                    <strong>{value.file}</strong>
                    <br>
                    <small class="text-muted">{value.disk}://{value.folder}/{value.file}</small>
                    <br>
                    <span>{value.size} {value.keywords}</span>',
                    'value'       => [
                        'file'     => 'entry.name',
                        'folder'   => 'entry.folder.slug',
                        'keywords' => 'entry.keywords.labels|join',
                        'disk'     => 'entry.folder.disk.slug',
                        'size'     => 'entry.size_label',
                    ],
                ],
                'size'                      => [
                    'sort_column' => 'size',
                    'value'       => 'entry.readable_size',
                ],
                'mime_type',
                'folder',
                'entry.created_at_datetime' => [
                    'heading'     => 'streams::entry.created_at',
                    'sort_column' => 'created_at',
                ],
            ],
        ],
        'trash'            => [
            'columns' => [
                'name',
                'size',
                'mime_type',
            ],
        ],
    ];

    /**
     * The table filters.
     *
     * @var array
     */
    protected $filters = [
        'search' => [
            'fields' => [
                'name',
                'keywords',
                'mime_type',
            ],
        ],
        'folder',
    ];

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'entry.preview' => [
            'heading' => 'anomaly.module.files::field.preview.name',
        ],
        'name'          => [
            'sort_column' => 'name',
            'wrapper'     => '
                    <strong>{value.file}</strong>
                    <br>
                    <small class="text-muted">{value.disk}://{value.folder}/{value.file}</small>
                    <br>
                    <span>{value.size} {value.keywords}</span>',
            'value'       => [
                'file'     => 'entry.name',
                'folder'   => 'entry.folder.slug',
                'keywords' => 'entry.keywords.labels|join',
                'disk'     => 'entry.folder.disk.slug',
                'size'     => 'entry.size_label',
            ],
        ],
        'size'          => [
            'sort_column' => 'size',
            'value'       => 'entry.readable_size',
        ],
        'mime_type',
        'folder',
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'edit',
        'view' => [
            'target' => '_blank',
        ],
    ];

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $actions = [
        'delete',
        'edit',
        'move' => [
            'tag'         => 'a',
            'type'        => 'info',
            'icon'        => 'upload',
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'href'        => 'admin/files/move/choose',
        ],
    ];
}
