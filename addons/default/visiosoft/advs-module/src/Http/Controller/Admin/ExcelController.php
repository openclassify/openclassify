<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Maatwebsite\Excel\Facades\Excel;
use Visiosoft\AdvsModule\Adv\AdvsImport;

class ExcelController extends AdminController
{
    public function import(FormBuilder $builder, FileRepositoryInterface $fileRepository)
    {
        if (request()->action == "save" and $file = $fileRepository->find(request()->file)) {
            if ($file->extension === 'xls' || $file->extension === 'xlsx') {
                $pathToFolder = "/storage/streams/".app(Application::class)->getReference()."/files-module/local/ads_excel/";
                Excel::import(new AdvsImport(), base_path() . $pathToFolder . $file->name);
                $this->messages->success(trans('streams::message.create_success', ['name' => trans('module::addon.title')]));
            }
        }

        //Form Render
        $builder->setFields([
            'file' => [
                "type" => "anomaly.field_type.file",
                "config" => [
                    'folders' => ["ads_excel"],
                    'mode' => 'upload'
                ]
            ],
        ]);
        $builder->setActions([
            'save'
        ]);

        $builder->setOptions([
            'redirect' => route('visiosoft.module.advs::admin_advs')
        ]);

        return $builder->render();
    }
}
