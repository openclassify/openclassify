<?php namespace Anomaly\PagesModule\Page\Support\MultipleFieldType;

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
        'title',
        'path',
    ];
}
