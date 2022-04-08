<?php namespace Anomaly\FileFieldType\Http\Controller;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Anomaly\FileFieldType\Table\FileTableBuilder;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FileFieldType\Table\ValueTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;

/**
 * Class FilesController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FilesController extends AdminController
{

    /**
     * Return an index of existing files.
     *
     * @param FileTableBuilder $table
     * @param                  $key
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FileTableBuilder $table, $key)
    {
        return $table->setConfig(Cache::get($key))->render();
    }

    /**
     * Return a list of folders to choose from.
     *
     * @param FolderRepositoryInterface $folders
     * @param                           $key
     *
     * @return \Illuminate\Contracts\View\View|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function choose(FolderRepositoryInterface $folders, $key)
    {
        $allowed = [];

        $config = Cache::get($key);

        foreach (Arr::get($config, 'folders', []) as $identifier) {

            /* @var FolderInterface $folder */
            if ($folder = $this->dispatch(new GetFolder($identifier))) {
                $allowed[] = $folder;
            }
        }

        if (!$allowed) {
            $allowed = $folders->all();
        }

        return $this->view->make(
            'anomaly.field_type.file::choose',
            [
                'key'     => $key,
                'folders' => $allowed,
            ]
        );
    }

    /**
     * Return a table of selected files.
     *
     * @param ValueTableBuilder $table
     *
     * @return null|string
     */
    public function selected(ValueTableBuilder $table)
    {
        return $table->setUploaded(explode(',', $this->request->get('uploaded')))->make()->getTableContent();
    }

    /**
     * Check if a file exists.
     *
     * @param FileRepositoryInterface $files
     * @param                         $folder
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function exists(FileRepositoryInterface $files, $folder)
    {
        $success = true;
        $exists = false;

        /* @var FolderInterface|null $folder */
        $folder = $this->dispatch(new GetFolder($folder));

        if ($folder && $file = $files->findByNameAndFolder($this->request->get('file'), $folder)) {
            $exists = true;
        }

        return $this->response->json(compact('success', 'exists'));
    }
}
