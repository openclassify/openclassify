<?php namespace Anomaly\PostsModule\Post\Form;

use Anomaly\PostsModule\Post\PostModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class PostEntryFormSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PostEntryFormSections
{

    /**
     * Handle the form sections.
     *
     * @param PostEntryFormBuilder $builder
     */
    public function handle(PostEntryFormBuilder $builder)
    {
        $builder->setSections(
            [
                'post'   => [
                    'tabs' => [
                        'general'      => [
                            'title'  => 'anomaly.module.posts::tab.general',
                            'fields' => [
                                'post_title',
                                'post_slug',
                                'post_summary',
                            ],
                        ],
                        'organization' => [
                            'title'  => 'anomaly.module.posts::tab.organization',
                            'fields' => [
                                'post_category',
                                'post_tags',
                            ],
                        ],
                        'seo'          => [
                            'title'  => 'anomaly.module.posts::tab.seo',
                            'fields' => [
                                'post_meta_title',
                                'post_meta_description',
                            ],
                        ],
                        'options'      => [
                            'title'  => 'anomaly.module.posts::tab.options',
                            'fields' => [
                                'post_enabled',
                                'post_featured',
                                'post_publish_at',
                                'post_author',
                            ],
                        ],
                    ],
                ],
                'fields' => [
                    'fields' => function (PostEntryFormBuilder $builder) {
                        return array_map(
                            function (FieldType $field) {
                                return 'entry_' . $field->getField();
                            },
                            array_filter(
                                $builder->getFormFields()->base()->all(),
                                function (FieldType $field) {
                                    return (!$field->getEntry() instanceof PostModel);
                                }
                            )
                        );
                    },
                ],
            ]
        );
    }
}
