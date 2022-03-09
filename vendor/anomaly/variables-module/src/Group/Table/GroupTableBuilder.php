<?php namespace Anomaly\VariablesModule\Group\Table;

use Anomaly\Streams\Platform\Stream\Table\StreamTableBuilder;

/**
 * Class GroupTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GroupTableBuilder extends StreamTableBuilder
{

    /**
     * The streams namespace.
     *
     * @var string
     */
    protected $namespace = 'variables';

    /**
     * The table buttons.
     *
     * @var array
     */
    protected $buttons = [
        'edit',
        'edit' => [
            'text' => 'module::button.manage',
            'href' => 'admin/variables/edit/{entry.id}',
        ],
        'assignments',
    ];
}
