<?php namespace Anomaly\DashboardModule;

use Anomaly\DashboardModule\Command\PublishAssets;
use Anomaly\DashboardModule\Dashboard\Contract\DashboardRepositoryInterface;
use Anomaly\DashboardModule\Dashboard\DashboardModel;
use Anomaly\DashboardModule\Dashboard\DashboardRepository;
use Anomaly\DashboardModule\Widget\Contract\WidgetRepositoryInterface;
use Anomaly\DashboardModule\Widget\WidgetModel;
use Anomaly\DashboardModule\Widget\WidgetRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Dashboard\DashboardDashboardsEntryModel;
use Anomaly\Streams\Platform\Model\Dashboard\DashboardWidgetsEntryModel;

/**
 * Class DashboardModuleServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DashboardModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon bindings.
     *
     * @var array
     */
    protected $bindings = [
        DashboardWidgetsEntryModel::class    => WidgetModel::class,
        DashboardDashboardsEntryModel::class => DashboardModel::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        WidgetRepositoryInterface::class    => WidgetRepository::class,
        DashboardRepositoryInterface::class => DashboardRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/dashboard'                   => 'Anomaly\DashboardModule\Http\Controller\Admin\DashboardsController@index',
        'admin/dashboard/manage'            => 'Anomaly\DashboardModule\Http\Controller\Admin\DashboardsController@manage',
        'admin/dashboard/create'            => 'Anomaly\DashboardModule\Http\Controller\Admin\DashboardsController@create',
        'admin/dashboard/edit/{id}'         => 'Anomaly\DashboardModule\Http\Controller\Admin\DashboardsController@edit',
        'admin/dashboard/view/{dashboard}'  => 'Anomaly\DashboardModule\Http\Controller\Admin\DashboardsController@view',
        'admin/dashboard/widgets'           => 'Anomaly\DashboardModule\Http\Controller\Admin\WidgetsController@index',
        'admin/dashboard/widgets/create'    => 'Anomaly\DashboardModule\Http\Controller\Admin\WidgetsController@create',
        'admin/dashboard/widgets/edit/{id}' => 'Anomaly\DashboardModule\Http\Controller\Admin\WidgetsController@edit',
        'admin/dashboard/widgets/choose'    => 'Anomaly\DashboardModule\Http\Controller\Admin\WidgetsController@choose',
        'admin/dashboard/widgets/save'      => 'Anomaly\DashboardModule\Http\Controller\Admin\WidgetsController@save',
    ];
}
