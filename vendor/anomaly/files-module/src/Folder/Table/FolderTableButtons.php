<?php namespace Anomaly\FilesModule\Folder\Table;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;

class FolderTableButtons
{

    public function handle(FolderTableBuilder $builder)
    {
        $builder->setButtons(
            [
                'edit',
                'upload'      => [
                    'icon' => 'upload',
                    'type' => 'success',
                    'href' => 'admin/files/upload/{entry.slug}',
                ],
                'assignments' => [
                    'href' => function (FolderInterface $entry) {
                        return '/admin/files/folders/assignments/' . $entry->getEntryStreamId();
                    },
                ],
            ]
        );
    }
}
