<?php namespace Anomaly\DatetimeFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class DatetimeFieldTypeServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DatetimeFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\DatetimeFieldType\DatetimeFieldTypeModifier' => 'Anomaly\DatetimeFieldType\DatetimeFieldTypeModifier',
    ];

}
