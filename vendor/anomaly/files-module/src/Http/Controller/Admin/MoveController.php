<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileManager;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class MoveController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MoveController extends AdminController
{

    /**
     * Return an ajax modal to choose the folder
     * to use for uploading files.
     *
     * @param FolderRepositoryInterface
     * @return \Illuminate\View\View
     */
    public function choose(FolderRepositoryInterface $folders)
    {
        return $this->view->make(
            'anomaly.module.files::admin/move/choose',
            [
                'folders' => $folders->all(),
            ]
        );
    }

    /**
     * @param FolderRepositoryInterface $folders
     * @param FileRepositoryInterface $files
     * @param FileManager $manager
     * @param $folder
     */
    public function handle(
        FolderRepositoryInterface $folders,
        FileRepositoryInterface $files,
        FileManager $manager,
        $folder
    ) {

        if (!$folder = $folders->findBySlug($folder)) {
            abort(400);
        }

        foreach ($selected = explode(',', request()->get('selected')) as $id) {

            /* @var FileInterface $file */
            if (!$file = $files->find($id)) {
                continue;
            }

            $manager->move($file->location(), $folder->path($file->getName()));
        }

        $this->messages->success(trans('streams::message.moved_success', compact('count')));

        return back();
    }
}
