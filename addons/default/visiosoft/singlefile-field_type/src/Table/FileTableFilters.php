<?php namespace Visiosoft\SinglefileFieldType\Table;

use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

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

        $config = $cache->get('singlefile-field_type::' . $request->route('key'), []);

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
                    'folder' => [
                        'exact'   => true,
                        'filter'  => 'select',
                        'options' => $allowed,
                        'enabled' => (count($allowed) !== 1),
                    ],
                    'search' => [
                        'columns' => [
                            'name',
                            'keywords',
                            'mime_type',
                        ],
                    ],
                ]
            );
    }
}
