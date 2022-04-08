<?php namespace Anomaly\BlocksModule\Type\Form;

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
                            'title'  => 'anomaly.module.blocks::tab.general',
                            'fields' => [
                                'name',
                                'slug',
                                'description',
                                'category',
                            ],
                        ],
                        'content' => [
                            'title'  => 'anomaly.module.blocks::tab.content',
                            'fields' => [
                                'content_layout',
                            ],
                        ],
                        'wrapper' => [
                            'title'  => 'anomaly.module.blocks::tab.wrapper',
                            'fields' => [
                                'wrapper_layout',
                            ],
                        ],
                    ],
                ],
            ]
        );
    }
}
