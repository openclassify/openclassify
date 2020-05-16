<?php namespace Visiosoft\MediaFieldType\Http\Controller;

use Anomaly\Streams\Platform\Image\Image;
use Anomaly\Streams\Platform\Model\Files\FilesFilesEntryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Visiosoft\MediaFieldType\Table\FileTableBuilder;
use Visiosoft\MediaFieldType\Table\UploadTableBuilder;
use Anomaly\FilesModule\File\FileUploader;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Intervention\Image\Facades\Image as WaterMark;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;

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
     * @param UploadTableBuilder $table
     * @param                        $folder
     * @return \Illuminate\View\View
     */
    public function index(UploadTableBuilder $table, $folder)
    {
        return $this->view->make(
            'visiosoft.field_type.media::upload/index',
            [
                'folder' => $this->dispatch(new GetFolder($folder)),
                'table' => $table->make()->getTable(),
            ]
        );
    }

    /**
     * Upload a file.
     *
     * @param FileUploader $uploader
     * @param FolderRepositoryInterface $folders
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(FileUploader $uploader, FolderRepositoryInterface $folders, SettingRepositoryInterface $settings, FileRepositoryInterface $files)
    {
        if ($file = $uploader->upload($this->request->file('upload'), $folders->find($this->request->get('folder')))) {

            $watermarktype = $settings->value('visiosoft.module.advs::watermark_type');
            $position = $settings->value('visiosoft.module.advs::watermark_position');
            $fullImg = WaterMark::make($this->request->file('upload')->getRealPath())
                    ->resize(null, setting_value('visiosoft.field_type.media::imageResizeH', 600),function ($constraint) {
                            $constraint->aspectRatio();
                    })
                    ->resizeCanvas(
                        setting_value('visiosoft.field_type.media::imageCanvasW', 800),
                        setting_value('visiosoft.field_type.media::imageCanvasH', 600),
                        'center', false, 'fff'
                    );
            $mdImg = WaterMark::make($this->request->file('upload')->getRealPath())
                    ->resize(null, setting_value('visiosoft.module.advs::picture_height'),function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->resizeCanvas(
                        setting_value('visiosoft.module.advs::picture_width', 400),
                        setting_value('visiosoft.module.advs::picture_height', 300),
                        'center', false, 'fff'
                    );
            foreach ([$fullImg, $mdImg] as $index => $image) {
                if ($watermarktype == 'image') {
                    $watermarkimage_id = $settings->value('visiosoft.module.advs::watermark_image');
                    $watermarkimage = $files->find($watermarkimage_id);
                    if ($watermarkimage != null) {
                        $watermark = WaterMark::make(app_storage_path() . '/files-module/local/' . $watermarkimage->path());
                        $image->insert($watermark, $position);
                    }
                } else {
                    $watermarktext = $settings->value('visiosoft.module.advs::watermark_text');
                    $v = "top";
                    $h = "center";
                    $w = $image->width() / 2;
                    $h1 = $image->height() / 2;
                    $font_size = $w / 20;
                    $image->text($watermarktext, $w, $h1, function ($font) use ($v, $h, $font_size) {
                        $font->file(public_path('Antonio-Bold.ttf'));
                        $font->size($font_size);
                        $font->align($h);
                        $font->valign($v);
                    });
                }
                if ($index === 0) {
                    $fileName = $file->getAttributes()['name'];
                } else {
                    $fileName = 'md-' . $file->getAttributes()['name'];

                    $files->create([
                        'folder_id' => $this->request->get('folder'),
                        'name' => $fileName,
                        'disk_id' => 1,
                        'size' => $image->filesize(),
                        'mime_type' => $image->mime,
                        'extension' => $image->extension,
                    ]);
                }
                $image->save(app_storage_path() . '/files-module/local/images/' . $fileName);
            }

            return $this->response->json($file->getAttributes());
        }

        return $this->response->json(['error' => 'There was a problem uploading the file.'], 500);
    }

    /**
     * Return the recently uploaded files.
     *
     * @param FileTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function recent(UploadTableBuilder $table)
    {
        return $table->setUploaded(explode(',', $this->request->get('uploaded')))
            ->make()
            ->getTableContent();
    }

    public function rotate(Image $image, Request $request)
    {
        $request = $request->toArray();
        $url = $request['img_url'];

        $parsed = parse_url($url);
        $path = explode('/', $parsed['path']);
        $filename = end($path);

        $isImageUser = FilesFilesEntryModel::query();
        if (!auth()->user()->hasRole('admin')) {
            $isImageUser = $isImageUser->where('created_by_id', Auth::id());
        }
        $isImageUser = $isImageUser->where('name', $filename)->first();
        if ($isImageUser != null) {
            WaterMark::make(Storage::path('images/' . $filename))->rotate(90)
                ->save(app_storage_path() . '/files-module/local/images/' . $filename);
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }
}
