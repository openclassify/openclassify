<?php namespace Anomaly\FilesModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\FileUploader;
use Anomaly\FilesModule\File\Upload\UploadTableBuilder;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Contracts\Auth\Guard;

/**
 * Class UploadController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class UploadController extends AdminController
{

    /**
     * Return the form to upload files.
     *
     * @param  FolderRepositoryInterface                  $folders
     * @param  UploadTableBuilder                         $table
     * @param  Guard                                      $auth
     * @param                                             $folder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(FolderRepositoryInterface $folders, UploadTableBuilder $table, Guard $auth, $folder)
    {
        $folder = $folders->findBySlug($folder);

        $table->make();

        $table = $table->getTable();

        return $this->view->make('anomaly.module.files::admin/upload/index', compact('folder', 'table'));
    }

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
            'anomaly.module.files::admin/upload/choose',
            [
                'folders' => $folders->all(),
            ]
        );
    }

    /**
     * Handle the upload.
     *
     * @param  FileUploader              $uploader
     * @param  FolderRepositoryInterface $folders
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(FileUploader $uploader, FolderRepositoryInterface $folders)
    {
        $error = trans('anomaly.module.files::error.generic');

        try {
            if ($file = $uploader->upload(
                $this->request->file('upload'),
                $folders->find($this->request->get('folder'))
            )
            ) {
                return $this->response->json($file->getAttributes());
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        return $this->response->json(['message' => $error], 500);
    }

    /**
     * Return table of uploaded files.
     *
     * @param  UploadTableBuilder $builder
     * @return null|string
     */
    public function recent(UploadTableBuilder $builder)
    {
        return $builder
            ->setUploaded(explode(',', $this->request->get('uploaded')))
            ->make()
            ->getTableContent();
    }
}
