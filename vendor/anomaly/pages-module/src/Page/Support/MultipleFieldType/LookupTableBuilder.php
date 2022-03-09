<?php namespace Anomaly\PagesModule\Page\Support\MultipleFieldType;

/**
 * Class LookupTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LookupTableBuilder extends \Anomaly\MultipleFieldType\Table\LookupTableBuilder
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
