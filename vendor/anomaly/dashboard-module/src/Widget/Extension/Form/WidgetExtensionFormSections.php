<?php namespace Anomaly\DashboardModule\Widget\Extension\Form;

/**
 * Class WidgetExtensionFormSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class WidgetExtensionFormSections
{

    /**
     * Handle the form sections.
     *
     * @param WidgetExtensionFormBuilder $builder
     */
    public function handle(WidgetExtensionFormBuilder $builder)
    {
        $widget        = $builder->getChildForm('widget');
        $configuration = $builder->getChildForm('configuration');

        $builder->setSections(
            [
                [
                    'fields' => function () use ($widget) {
                        return array_map(
                            function ($field) {
                                return 'widget_' . $field;
                            },
                            $widget->getFormFieldSlugs()
                        );
                    },
                ],
                [
                    'fields' => function () use ($configuration) {
                        return array_map(
                            function ($field) {
                                return 'configuration_' . $field;
                            },
                            $configuration->getFormFieldSlugs()
                        );
                    },
                ],
            ]
        );
    }
}
