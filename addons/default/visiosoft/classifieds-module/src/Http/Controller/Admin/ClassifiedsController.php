<?php namespace Visiosoft\ClassifiedsModule\Http\Controller\Admin;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Model\Classifieds\ClassifiedsClassifiedsEntryTranslationsModel;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;
use Visiosoft\ClassifiedsModule\Classified\ClassifiedModel;
use Visiosoft\ClassifiedsModule\Classified\Event\ChangedStatusClassified;
use Visiosoft\ClassifiedsModule\Classified\Form\SimpleClassifiedFormBuilder;
use Visiosoft\ClassifiedsModule\Classified\Table\ClassifiedTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\ClassifiedsModule\Option\Contract\OptionRepositoryInterface;
use Visiosoft\AlgoliaModule\Search\SearchModel;
use Maatwebsite\Excel\Facades\Excel;
use Visiosoft\ClassifiedsModule\Classified\ClassifiedsExport;

class ClassifiedsController extends AdminController
{
    private $model;
    private $classifiedRepository;
    private $classifiedsEntryTranslationsModel;
    private $optionRepository;

    public function __construct(
        ClassifiedModel $model,
        ClassifiedRepositoryInterface $classifiedRepository,
        ClassifiedsClassifiedsEntryTranslationsModel $classifiedsEntryTranslationsModel,
        OptionRepositoryInterface $optionRepository
    )
    {
        parent::__construct();
        $this->model = $model;
        $this->classifiedRepository = $classifiedRepository;
        $this->classifiedsEntryTranslationsModel = $classifiedsEntryTranslationsModel;
        $this->optionRepository = $optionRepository;
    }

    public function index(ClassifiedTableBuilder $table)
    {
        $table->addAsset("styles.css", "visiosoft.module.classifieds::css/custom.css");
        $table->addAsset('scripts.js', 'visiosoft.module.classifieds::js/list.js');

        return $table->render();
    }

    public function create(SimpleClassifiedFormBuilder $form)
    {
        return $form->render();
    }

    public function edit(SimpleClassifiedFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    public function choose($classifiedId, Request $request, UserRepositoryInterface $users)
    {
        if (empty($request->all())) {
            return $this->view->make('module::admin/classifieds/choose', ['users' => $users->all(), 'classifiedId' => $classifiedId]);
        } else {
            $this->model->newQuery()->find($classifiedId)->update(['created_by_id' => $request->user_id]);
            $this->messages->success(trans('module::message.owner_updated_successfully'));
            return redirect()->back();
        }
    }

    public function actions($id, $type, SettingRepositoryInterface $settings, ClassifiedModel $classifiedModel)
    {
        $classified = $classifiedModel->where('classifieds_classifieds.id', '=', $id)->first();
        $classified->status = $type;

        $default_classified_publish = $settings->value('visiosoft.module.classifieds::default_published_time');
        $classified->finish_at = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $default_classified_publish . ' day'));
        $classified->publish_at = date('Y-m-d H:i:s');

        //algolia Search Module
        $isActiveAlgolia = $classifiedModel->is_enabled('algolia');
        if ($isActiveAlgolia) {
            $algolia = new SearchModel();
            $algolia->updateStatus($id, $type, $settings);
        }
        $classified->update();
        event(new ChangedStatusClassified($classified));//Create Notify
        return back();
    }

    public function replicate($classifiedID)
    {
        try {
            $classified = $this->classifiedRepository->find($classifiedID);
            if (!$classified) {
                throw new \Exception(trans('visiosoft.module.classifieds::message.classified_doesnt_exist'));
            } else {
                // Replicate classified
                $classified = $classified->toArray();
                unset(
                    $classified['id'],
                    $classified['sort_order'],
                    $classified['cover_photo'],
                    $classified['locale'],
                    $classified['name'],
                    $classified['classifieds_desc']
                );
                $newClassified = $this->classifiedRepository->create(array_merge($classified, [
                    'slug' => $classified['slug'] . '_' . time(),
                ]));

                // Replicate classified translations
                $classifiedTranslations = $this->classifiedsEntryTranslationsModel->newQuery()->where('entry_id', $classifiedID)->get();
                $translations = array();
                foreach ($classifiedTranslations as $classifiedTranslation) {
                    $translations[$classifiedTranslation->locale] = [
                        'name' => $classifiedTranslation->name,
                        'classifieds_desc' => $classifiedTranslation->classifieds_desc,
                    ];
                }
                $newClassified->update($translations);

                // Replicate classified options
                $classifiedOptions = $this->optionRepository->newQuery()->where('classified_id', $classifiedID)->get();
                foreach ($classifiedOptions as $classifiedOption) {
                    $newClassifiedOption = $classifiedOption->replicate();
                    $newClassifiedOption->classified_id = $newClassified->id;
                    $newClassifiedOption->save();
                }

                // Replicate classified custom fields
                $classifiedCustomFields = $this->model->is_enabled('customfields');
                if ($classifiedCustomFields) {
                    $classifiedCustomFields = app('Visiosoft\CustomfieldsModule\CustomFieldClassified\Contract\CustomFieldClassifiedRepositoryInterface')
                        ->newQuery()->where('parent_classified_id', $classifiedID)->get();
                    foreach ($classifiedCustomFields as $classifiedCustomField) {
                        $newaClassifiedCustomField = $classifiedCustomField->replicate();
                        $newaClassifiedCustomField->parent_classified_id = $newClassified->id;
                        $newaClassifiedCustomField->save();
                    }
                }

                $this->messages->success(trans('visiosoft.module.classifieds::message.replicated_success'));
            }

            return redirect('admin/classifieds');
        } catch (\Exception $e) {
            $this->messages->error($e->getMessage());
            return redirect('admin/classifieds');
        }
    }

    public function assetsClear(Filesystem $files, Application $application, Request $request)
    {
        $directory = 'assets';
        $files->deleteDirectory($directory = $application->getAssetsPath($directory), true);
        echo "<div class='bar'></div>" . "<br>";
        echo "<style>
.bar {
  width: 30%;
  height: 20px;
  border: 1px solid #2980b9;
  border-radius: 3px;
  background-image: 
    repeating-linear-gradient(
      -45deg,
      #2980b9,
      #2980b9 11px,
      #eee 10px,
      #eee 20px /* determines size */
    );
  background-size: 28px 28px;
  animation: move .5s linear infinite;
}

@keyframes move {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 28px 0;
  }
}

</style>
        <script>
        location.href = '" . $request->server('HTTP_REFERER') . "';
        </script>
        
        <a href='" . $request->server('HTTP_REFERER') . "'><b>Return Back</b></a>";
        echo "<br><a href='/admin'><b>Return Admin Panel</b></a>";
    }


    public function exportClassifieds()
    {
        return Excel::download(new ClassifiedsExport(), 'classifieds-' . time() . '.xlsx');
    }

    public function classifiedancedUpdate()
    {
        if ($this->request->has('edit_column') and $this->request->has('edit_entry_id') and $this->request->has('edit_value')) {
            $entry_id = $this->request->get('edit_entry_id');
            $column = $this->request->get('edit_column');
            $value = $this->request->get('edit_value');
            if ($entry = $this->classifiedRepository->find($entry_id)) {
                $entry->setAttribute($column, $value);
                $entry->save();
            }
        }
    }
}
