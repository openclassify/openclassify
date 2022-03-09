<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Event\SortNavigation;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;

/**
 * Class NavigationSorter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class NavigationSorter
{

    /**
     * Create a new NavigationSorter instance.
     *
     * @param ControlPanelBuilder $builder
     */
    public function sort(ControlPanelBuilder $builder)
    {
        if (!$navigation = $builder->getNavigation()) {
            return;
        }

        ksort($navigation);

        /**
         * Make the namespaces the key now
         * that we've applied default sorting.
         */
        $navigation = array_combine(
            array_map(
                function ($item) {
                    return $item['slug'];
                },
                $navigation
            ),
            array_values($navigation)
        );

        /**
         * Again by default push the dashboard
         * module to the top of the navigation.
         */
        foreach ($navigation as $key => $module) {

            if ($key == 'anomaly.module.dashboard') {

                $navigation = [$key => $module] + $navigation;

                break;
            }
        }

        $builder->setNavigation($navigation);

        event(new SortNavigation($builder));
    }
}
