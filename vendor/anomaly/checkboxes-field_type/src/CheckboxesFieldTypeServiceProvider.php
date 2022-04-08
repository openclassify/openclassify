<?php namespace Anomaly\CheckboxesFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class CheckboxesFieldTypeServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\CheckboxesFieldType
 */
class CheckboxesFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        'Anomaly\CheckboxesFieldType\CheckboxesFieldTypeModifier' => 'Anomaly\CheckboxesFieldType\CheckboxesFieldTypeModifier'
    ];

}
