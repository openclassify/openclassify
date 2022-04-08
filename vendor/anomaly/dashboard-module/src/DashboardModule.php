<?php namespace Anomaly\DashboardModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class DashboardModule
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DashboardModule extends Module
{

    /**
     * The module icon.
     *
     * @var string
     */
    protected $icon = 'dashboard';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'dashboards' => [
            'buttons' => [
                'new_dashboard' => [
                    'enabled' => 'admin/dashboard/manage',
                ],
                'manage'        => [
                    'type'       => 'info',
                    'icon'       => 'wrench',
                    'enabled'    => 'admin/dashboard/view/*',
                    'permission' => 'anomaly.module.dashboard::dashboards.write',
                ],
                'new_widget'    => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'enabled'     => 'admin/dashboard/view/*',
                    'href'        => 'admin/dashboard/widgets/choose',
                    'permission'  => 'anomaly.module.dashboard::widgets.write',
                ],
            ],
        ],
        'widgets'    => [
            'buttons' => [
                'new_widget' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/dashboard/widgets/choose',
                ],
                'find_widgets' => [
                    'button' => 'information',
                    'text' => 'anomaly.module.dashboard::button.find_widgets',
                    'href' => '/admin/addons?view=all&filter_search=widget',
                ],
            ],
        ],
    ];

}
