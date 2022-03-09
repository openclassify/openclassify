<?php namespace Anomaly\FilesFieldType\Table;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

/**
 * Class FileTableFilters
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileTableFilters
{
    use DispatchesJobs;

    /**
     * @param FileTableBuilder $builder
     * @param FolderRepositoryInterface $folders
     * @param Request $request
     */
    public function handle(
        FileTableBuilder $builder,
        FolderRepositoryInterface $folders,
        Request $request
    ) {
        $allowed = [];

        $config = Cache::get($request->route('key'));

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
