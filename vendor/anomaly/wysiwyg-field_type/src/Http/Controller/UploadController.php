<?php namespace Anomaly\WysiwygFieldType\Http\Controller;

use Anomaly\FilesModule\File\FileUploader;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\WysiwygFieldType\Table\FileTableBuilder;
use Anomaly\WysiwygFieldType\Table\UploadTableBuilder;

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
     * Return the uploader.
     *
     * @param  FolderRepositoryInterface $folders
     * @param                            $folder
     * @return \Illuminate\View\View
     */
    public function index(FolderRepositoryInterface $folders, UploadTableBuilder $table, $folder)
    {
        return $this->view->make(
            'anomaly.field_type.wysiwyg::upload/index',
            [
                'folder' => $folders->find($folder),
                'table'  => $table->make()->getTable(),
            ]
        );
    }

    /**
     * Upload a file.
     *
     * @param  FileUploader                  $uploader
     * @param  FolderRepositoryInterface     $folders
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(FileUploader $uploader, FolderRepositoryInterface $folders)
    {
        if ($file = $uploader->upload($this->request->file('upload'), $folders->find($this->request->get('folder')))) {
            return $this->response->json($file->getAttributes());
        }

        return $this->response->json(['error' => 'There was a problem uploading the file.'], 500);
    }

    /**
     * Return the recently uploaded files.
     *
     * @param  FileTableBuilder                           $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function recent(UploadTableBuilder $table)
    {
        return $table->setUploaded(explode(',', $this->request->get('uploaded')))
            ->setMode($this->request->get('mode', 'file'))
            ->make()
            ->getTableContent();
    }
}
