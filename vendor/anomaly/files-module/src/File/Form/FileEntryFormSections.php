<?php namespace Anomaly\FilesModule\File\Form;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

/**
 * Class FileEntryFormSections
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileEntryFormSections
{

    /**
     * Handle the form sections.
     *
     * @param FileEntryFormBuilder $builder
     */
    public function handle(FileEntryFormBuilder $builder)
    {
        $entryForm = $builder->getChildForm('entry');

        /* @var EntryInterface $entry */
        $entry = $entryForm->getFormEntry();

        $builder->setSections(
            [
                'default' => [
                    'tabs' => [
                        'file' => [
                            'title'  => 'anomaly.module.files::tab.file',
                            'fields' => [
                                'file_name',
                                'file_title',
                                'file_description',
                                'file_keywords',
                            ],
                        ],
                        'seo'  => [
                            'title'  => 'anomaly.module.files::tab.seo',
                            'fields' => [
                                'file_alt_text',
                                'file_caption',
                            ],
                        ],
                    ],
                ],
                'fields'  => [
                    'fields' => function () use ($entry) {
                        return array_map(
                            function ($slug) {
                                return 'entry_' . $slug;
                            },
                            $entry->getAssignmentFieldSlugs()
                        );
                    },
                ],
            ]
        );
    }
}
