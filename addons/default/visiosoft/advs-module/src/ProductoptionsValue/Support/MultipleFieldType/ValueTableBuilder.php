<?php namespace Visiosoft\AdvsModule\ProductoptionsValue\Support\MultipleFieldType;

/**
 * Class ValueTableBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ValueTableBuilder extends \Anomaly\MultipleFieldType\Table\ValueTableBuilder
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
