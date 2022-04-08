<?php namespace Anomaly\DashboardModule\Widget\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class WidgetTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class WidgetTableBuilder extends TableBuilder
{

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [
        'search' => [
            'fields' => [
                'title',
                'description',
            ],
        ],
        'dashboard',
        'extension',
    ];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'title',
        'description',
        'dashboard',
        'entry.extension.title',
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit',
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete',
    ];

}
