<?php namespace Visiosoft\SinglefileFieldType\Http\Controller;

use Visiosoft\SinglefileFieldType\Table\FileTableBuilder;
use Visiosoft\SinglefileFieldType\Table\UploadTableBuilder;
use Anomaly\FilesModule\File\FileUploader;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class UploadController
 *
 * @link          http://openclassify.com/
 * @author        OpenClassify, Inc. <support@openclassify.com>
 * @author        Visiosoft Inc <support@openclassify.com>
 */
class UploadController extends AdminController
{

    use DispatchesJobs;

    /**
     * Return the uploader.
     *
     * @param  UploadTableBuilder    $table
     * @param                        $folder
     * @return \Illuminate\View\View
     */
    public function index(UploadTableBuilder $table, $folder)
    {
        return $this->view->make(
            'visiosoft.field_type.singlefile::upload/index',
            [
                'folder' => $this->dispatch(new GetFolder($folder)),
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
            ->make()
            ->getTableContent();
    }
}
