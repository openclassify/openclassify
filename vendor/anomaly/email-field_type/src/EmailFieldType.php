<?php namespace Anomaly\EmailFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class EmailFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class EmailFieldType extends FieldType
{

    /**
     * Field type validation rules.
     *
     * @var array
     */
    protected $rules = [
        'email',
    ];

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.email::input';

    /**
     * The filter view.
     *
     * @var string
     */
    protected $filterView = 'anomaly.field_type.email::filter';

}
