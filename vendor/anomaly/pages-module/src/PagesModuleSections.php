<?php namespace Anomaly\PagesModule;

use Anomaly\PreferencesModule\Preference\Contract\PreferenceRepositoryInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class PagesModuleSections
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PagesModuleSections
{

    /**
     * Handle the sections.
     *
     * @param ControlPanelBuilder           $builder
     * @param PreferenceRepositoryInterface $preferences
     */
    public function handle(ControlPanelBuilder $builder, PreferenceRepositoryInterface $preferences)
    {
        $view = $preferences->value('anomaly.module.pages::page_view', 'tree');

        $builder->setSections(
            [
                'pages'  => [
                    'buttons' => [
                        'new_page'    => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'href'        => 'admin/pages/types/choose',
                        ],
                        'change_view' => [
                            'type'    => 'info',
                            'enabled' => 'admin/pages',
                            'icon'    => ($view == 'tree' ? 'fa fa-table' : 'list-ul'),
                            'href'    => 'admin/pages/change/' . ($view == 'tree' ? 'table' : 'tree'),
                            'text'    => 'anomaly.module.pages::button.' . ($view == 'tree' ? 'table_view' : 'tree_view'),
                        ],
                    ],
                ],
                'types'  => [
                    'buttons'  => [
                        'new_type',
                    ],
                    'sections' => [
                        'assignments' => [
                            'hidden'  => true,
                            'href'    => 'admin/pages/types/assignments/{request.route.parameters.stream}',
                            'buttons' => [
                                'assign_fields' => [
                                    'data-toggle' => 'modal',
                                    'data-target' => '#modal',
                                    'href'        => 'admin/pages/types/assignments/{request.route.parameters.stream}/choose',
                                ],
                            ],
                        ],
                    ],
                ],
                'fields' => [
                    'buttons' => [
                        'new_field' => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'href'        => 'admin/pages/fields/choose',
                        ],
                    ],
                ],
            ]
        );
    }
}
