<?php namespace Anomaly\PostsModule\Category\Form;

/**
 * Class CategoryFormSections
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CategoryFormSections
{

    /**
     * Handle the sections.
     *
     * @param CategoryFormBuilder $builder
     */
    public function handle(CategoryFormBuilder $builder)
    {
        $stream = $builder->getFormStream();

        $fields = $stream
            ->getAssignments()
            ->unlocked()
            ->fieldSlugs();

        $builder->setSections(
            [
                'category' => [
                    'tabs' => [
                        'general' => [
                            'title'  => 'anomaly.module.posts::tab.general',
                            'fields' => [
                                'name',
                                'slug',
                                'description',
                            ],
                        ],
                        'seo'     => [
                            'title'  => 'anomaly.module.posts::tab.seo',
                            'fields' => [
                                'meta_title',
                                'meta_description',
                            ],
                        ],
                    ],
                ],
                'content'  => [
                    'fields' => $fields,
                ],
            ]
        );
    }
}
