<?php namespace Visiosoft\MediaFieldType\Http\Controller;

use Anomaly\Streams\Platform\Image\Image;
use Anomaly\Streams\Platform\Model\Files\FilesFilesEntryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Visiosoft\MediaFieldType\Table\UploadTableBuilder;
use Anomaly\FilesModule\File\FileUploader;
use Anomaly\FilesModule\Folder\Command\GetFolder;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Intervention\Image\Facades\Image as WaterMark;
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
    public $uploader;
    public $folders;
    public $files;

    use DispatchesJobs;

    public function __construct(FileUploader $uploader, FolderRepositoryInterface $folders, FileRepositoryInterface $files)
    {
        $this->uploader = $uploader;
        $this->folders = $folders;
        $this->files = $files;
        parent::__construct();
    }

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

    public function upload()
    {
        $mimes = explode('/', $this->request->file('upload')->getMimeType());

        if ($mimes[0] == 'image') {
            $file = $this->uploader->upload($this->request->file('upload'), $this->folders->find($this->request->get('folder')));
        } else if ($doc_folder = app(FolderRepositoryInterface::class)->findBySlug('ads_documents')) {
            $file = $this->uploader->upload($this->request->file('upload'), $doc_folder);
        } else {
            return $this->response->json(['error' => trans('visiosoft.field_type.media::message.error_upload_docs')], 500);
        }

        if ($file) {
            if ($mimes[0] == 'image') {

                $settings_key = [
                    'image_resize_backend',
                    'full_image_width',
                    'full_image_height',
                    'medium_image_width',
                    'medium_image_height',
                    'thumbnail_width',
                    'thumbnail_height',
                    'add_canvas',
                    'image_canvas_width',
                    'image_canvas_height',
                    'watermark_type',
                    'watermark_text',
                    'watermark_image',
                    'watermark_position'
                ];

                $settings_value = array();

                foreach ($settings_key as $key) {
                    $settings_value[$key] = setting_value('visiosoft.module.advs::' . $key);
                }


                $fullImg = WaterMark::make($this->request->file('upload')->getRealPath());

                if ($settings_value['image_resize_backend']) {
                    $fullImg = $fullImg->resize(null, $settings_value['full_image_height'],
                        function ($constraint) {
                            $constraint->aspectRatio();
                        });
                }

                $mdImg = WaterMark::make($this->request->file('upload')->getRealPath())
                    ->resize(null, $settings_value['medium_image_height'], function ($constraint) {
                        $constraint->aspectRatio();
                    });

                if ($settings_value['add_canvas']) {

                    $fullImg->resizeCanvas(
                        $settings_value['image_canvas_width'], $settings_value['image_canvas_height'],
                        'center', false, 'fff'
                    );

                    $mdImg->resizeCanvas(
                        $settings_value['medium_image_width'], $settings_value['medium_image_height'],
                        'center', false, 'fff'
                    );
                }

                $image_types = array('full' => $fullImg, 'medium' => $mdImg);

                foreach ($image_types as $key => $image) {

                    if (setting_value('visiosoft.module.advs::watermark', false)) {
                        if ($settings_value['watermark_type'] == 'image') {

                            if ($watermarkimage = $this->files->find($settings_value['watermark_image'])) {
                                $watermark = WaterMark::make(app_storage_path() . '/files-module/local/' . $watermarkimage->path());
                                $image->insert($watermark, $settings_value['watermark_position']);
                            }

                        } else {
                            $v = "top";
                            $h = "center";
                            $w = $image->width() / 2;
                            $h1 = $image->height() / 2;
                            $font_size = $w / 20;
                            $image->text(($watermark_text = setting_value('visiosoft.module.advs::watermark_text')) ? $watermark_text : 'Openclassify', $w, $h1, function ($font) use ($v, $h, $font_size) {
                                $font->file(public_path('Antonio-Bold.ttf'));
                                $font->size($font_size);
                                $font->align($h);
                                $font->valign($v);
                            });

                        }
                    }

                    if ($key === "full") {
                        $fileName = $file->getAttributes()['name'];
                    } else {
                        $fileName = 'md-' . $file->getAttributes()['name'];

                        $this->createFile($this->request->get('folder'), $fileName, $image);
                    }
                    $image->save(app_storage_path() . '/files-module/local/images/' . $fileName);
                }
            }
            return $this->response->json($file->getAttributes());
        }

        return $this->response->json(['error' => trans('visiosoft.field_type.media::message.error_upload')], 500);
    }

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

    public function createFile($folder, $filename, $image = null)
    {
        $this->files->create([
            'folder_id' => $folder,
            'name' => $filename,
            'disk_id' => 1,
            'size' => $image->filesize(),
            'mime_type' => $image->mime,
            'extension' => $image->extension,
        ]);
    }
}
