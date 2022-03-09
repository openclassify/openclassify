<?php namespace Anomaly\PostsModule\Type\Form;

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
     * Handle the section.
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
                            'title'  => 'anomaly.module.posts::tab.general',
                            'fields' => [
                                'name',
                                'slug',
                                'description',
                            ],
                        ],
                        'layout'  => [
                            'title'  => 'anomaly.module.posts::tab.layout',
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
