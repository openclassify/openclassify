<?php namespace Anomaly\RepeatersModule;

use Anomaly\RepeatersModule\Http\Controller\Admin\AssignmentsController;
use Anomaly\RepeatersModule\Http\Controller\Admin\FieldsController;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Assignment\AssignmentRouter;
use Anomaly\Streams\Platform\Field\FieldRouter;

/**
 * Class RepeatersModuleServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RepeatersModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/repeaters'           => 'Anomaly\RepeatersModule\Http\Controller\Admin\StreamsController@index',
        'admin/repeaters/create'    => 'Anomaly\RepeatersModule\Http\Controller\Admin\StreamsController@create',
        'admin/repeaters/edit/{id}' => 'Anomaly\RepeatersModule\Http\Controller\Admin\StreamsController@edit',
    ];

    /**
     * Map the addon.
     *
     * @param FieldRouter      $fields
     * @param AssignmentRouter $assignments
     */
    public function map(FieldRouter $fields, AssignmentRouter $assignments)
    {
        $fields->route($this->addon, FieldsController::class);
        $assignments->route($this->addon, AssignmentsController::class);
    }
}
