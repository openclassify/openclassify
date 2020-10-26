<?php namespace Visiosoft\AdvsModule\ProductoptionsValue\Support\MultipleFieldType;

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
	    'name', 'product_option'
    ];
}
