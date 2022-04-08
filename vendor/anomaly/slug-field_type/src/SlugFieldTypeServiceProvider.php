<?php namespace Anomaly\SlugFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class SlugFieldTypeServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SlugFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * Singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\SlugFieldType\SlugFieldTypeModifier' => 'Anomaly\SlugFieldType\SlugFieldTypeModifier',
    ];

}
