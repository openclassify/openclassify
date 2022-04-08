<?php namespace Anomaly\PagesModule\Type\Form;

/**
 * Class TypeFormSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class TypeFormSections
{

    /**
     * Handle the form sections.
     *
     * @param TypeFormBuilder $builder
     */
    public function handle(TypeFormBuilder $builder)
    {
        $builder->setSections(
            [
                'type' => [
                    'tabs' => [
                        'general' => [
                            'title'  => 'anomaly.module.pages::tab.general',
                            'fields' => [
                                'name',
                                'slug',
                                'description',
                                'handler',
                            ],
                        ],
                        'layout'  => [
                            'title'  => 'anomaly.module.pages::tab.layout',
                            'fields' => [
                                'theme_layout',
                                'layout',
                            ],
                        ],
                    ],
                ],
            ]
        );
    }
}
