<?php namespace Visiosoft\MediaFieldType\Http\Controller;

use Visiosoft\MediaFieldType\Table\FileTableBuilder;
use Visiosoft\MediaFieldType\Table\ValueTableBuilder;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Http\Request;

/**
 * Class FilesController
 *
 * @link          http://openclassify.com/
 * @author        OpenClassify, Inc. <support@openclassify.com>
 * @author        Visiosoft Inc <support@openclassify.com>
 */
class FilesController extends AdminController
{

    /**
     * Return an index of existing files.
     *
     * @param  FileTableBuilder                           $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FileTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return a list of folders to choose from.
     *
     * @param  FolderRepositoryInterface $folders
     * @return \Illuminate\View\View
     */
    public function choose(FolderRepositoryInterface $folders, Repository $cache, Request $request)
    {
        $allowed = [];

        $config = $cache->get('media-field_type::' . $request->route('key'), []);

        foreach (array_get($config, 'folders', []) as $identifier) {

            /* @var FolderInterface $folder */
            if ($folder = $this->dispatch(new GetFolder($identifier))) {
                $allowed[] = $folder;
            }
        }

        if (!$allowed) {
            $allowed = $folders->all();
        }

        return $this->view->make(
            'visiosoft.field_type.media::choose',
            [
                'folders' => $allowed,
            ]
        );
    }

    /**
     * Return a table of select items.
     *
     * @param  ValueTableBuilder $table
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function exists(FileRepositoryInterface $files, $folder)
    {
        $success = true;
        $exists  = false;

        /* @var FolderInterface|null $folder */
        $folder = $this->dispatch(new GetFolder($folder));

        if ($folder && $file = $files->findByNameAndFolder($this->request->get('file'), $folder)) {
            $exists = true;
        }

        return $this->response->json(compact('success', 'exists'));
    }
}
