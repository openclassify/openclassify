<?php namespace Visiosoft\MediaFieldType\Table;

use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class FileTableFilters
 *
 * @link          http://openclassify.com/
 * @author        OpenClassify, Inc. <support@openclassify.com>
 * @author        Visiosoft Inc <support@openclassify.com>
 */
class FileTableFilters
{
    use DispatchesJobs;

    /**
     * Handle the filters.
     *
     * @param FileTableBuilder          $builder
     * @param FolderRepositoryInterface $folders
     * @param Repository                $cache
     * @param Request                   $request
     */
    public function handle(
        FileTableBuilder $builder,
        FolderRepositoryInterface $folders,
        Repository $cache,
        Request $request
    ) {
        $allowed = [];

        $config = $cache->get('media-field_type::' . $request->route('key'), []);

        foreach (array_get($config, 'folders', []) as $identifier) {

            /* @var FolderInterface $folder */
            if ($folder = $this->dispatch(new GetFolder($identifier))) {
                $allowed[$folder->getId()] = $folder->getName();
            }
        }

        if (!$allowed) {
            $allowed = $folders->all()->pluck('name', 'id')->all();
        }

        $builder
            ->setFolders($allowed)
            ->setFilters(
                [
                    'search' => [
                        'columns' => [
                            'name',
                            'keywords',
                            'mime_type',
                        ],
                    ],
                    'folder' => [
                        'exact'   => true,
                        'filter'  => 'select',
                        'options' => $allowed,
                        'enabled' => (count($allowed) !== 1),
                    ],
                ]
            );
    }
}
