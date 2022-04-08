<?php namespace Anomaly\RobotsExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class RobotsExtensionServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\RobotsExtension
 */
class RobotsExtensionServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'robots.txt' => 'Anomaly\RobotsExtension\Http\Controller\RobotsController@view'
    ];

}
