<?php namespace Anomaly\UsersModule\User\Support\MultipleFieldType;

/**
 * Class SelectedTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SelectedTableBuilder extends \Anomaly\MultipleFieldType\Table\SelectedTableBuilder
{

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [
        'display_name',
        'username',
        'email',
        'status' => [
            'value' => 'entry.status_label',
        ],
    ];
}
