<?php namespace Anomaly\BlocksFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class BlocksFieldTypeServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\BlocksFieldType
 */
class BlocksFieldTypeServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'streams/blocks-field_type/choose/{field}'           => 'Anomaly\BlocksFieldType\Http\Controller\BlocksController@choose',
        'streams/blocks-field_type/form/{field}/{extension}' => 'Anomaly\BlocksFieldType\Http\Controller\BlocksController@form',
    ];
}
