<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryTranslationsModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Visiosoft\AdvsModule\Adv\AdvRepository;
use Visiosoft\AdvsModule\Adv\Command\UpdateClassifiedStatus;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Form\SimpleAdvFormBuilder;
use Visiosoft\AdvsModule\Adv\Table\AdvTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\AdvsModule\Option\Contract\OptionRepositoryInterface;
use Visiosoft\AlgoliaModule\Search\SearchModel;
use Maatwebsite\Excel\Facades\Excel;
use Visiosoft\AdvsModule\Adv\AdvsExport;

class AdvsController extends AdminController
{
    private $model;
    private $advRepository;
    private $advsEntryTranslationsModel;
    private $optionRepository;

    public function __construct(
        AdvModel                       $model,
        AdvRepositoryInterface         $advRepository,
        AdvsAdvsEntryTranslationsModel $advsEntryTranslationsModel,
        OptionRepositoryInterface      $optionRepository
    )
    {
        parent::__construct();
        $this->model = $model;
        $this->advRepository = $advRepository;
        $this->advsEntryTranslationsModel = $advsEntryTranslationsModel;
        $this->optionRepository = $optionRepository;
    }

    public function index(AdvTableBuilder $table)
    {
        $table->addAsset("styles.css", "visiosoft.module.advs::css/custom.css");
        $table->addAsset('scripts.js', 'visiosoft.module.advs::js/list.js');

        return $table->render();
    }

    public function create(SimpleAdvFormBuilder $form)
    {
        return $form->render();
    }

    public function edit(SimpleAdvFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    public function choose($advId, Request $request, UserRepositoryInterface $users)
    {
        if (empty($request->all())) {
            return $this->view->make('module::admin/advs/choose', ['users' => $users->all(), 'advId' => $advId]);
        } else {
            $this->model->newQuery()->find($advId)->update(['created_by_id' => $request->user_id]);
            $this->messages->success(trans('module::message.owner_updated_successfully'));
            return redirect()->back();
        }
    }

    public function actions($id, $type)
    {
        $ad = $this->advRepository->find($id);

        $this->dispatchSync(new UpdateClassifiedStatus($ad, $type));

        // Algolia Search Module
        $isActiveAlgolia = is_module_installed('visiosoft.module.algolia');
        if ($isActiveAlgolia) {
            $algolia = new SearchModel();
            $algolia->updateStatus($id, $type);
        }

        return back();
    }

    public function replicate($advID)
    {
        try {
            $adv = $this->advRepository->find($advID);
            if (!$adv) {
                throw new \Exception(trans('visiosoft.module.advs::message.ad_doesnt_exist'));
            } else {
                // Replicate ad
                $adv = $adv->toArray();
                unset(
                    $adv['id'],
                    $adv['sort_order'],
                    $adv['cover_photo'],
                    $adv['locale'],
                    $adv['name'],
                    $adv['advs_desc'],
                    $adv['detail_url'],
                    $adv['currency_price'],
                    $adv['category1'],
                    $adv['category2'],
                    $adv['thumbnail'],
                    $adv['video'],
                );
                $newAdv = $this->advRepository->create(array_merge($adv, [
                    'slug' => $adv['slug'] . '_' . time(),
                ]));
                // Replicate ad translations
                $advTranslations = $this->advsEntryTranslationsModel->newQuery()->where('entry_id', $advID)->get();
                $translations = array();
                foreach ($advTranslations as $advTranslation) {
                    $translations[$advTranslation->locale] = [
                        'name' => $advTranslation->name,
                        'advs_desc' => $advTranslation->advs_desc,
                    ];
                }
                $newAdv->update($translations);

                // Replicate ad options
                $advOptions = $this->optionRepository->newQuery()->where('adv_id', $advID)->get();
                foreach ($advOptions as $advOption) {
                    $newAdvOption = $advOption->replicate();
                    $newAdvOption->adv_id = $newAdv->id;
                    $newAdvOption->save();
                }

                $this->messages->success(trans('visiosoft.module.advs::message.replicated_success'));
            }

            return redirect('admin/advs');
        } catch (\Exception $e) {
            $this->messages->error($e->getMessage());
            return redirect('admin/advs');
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


    public function exportAdvs(FormBuilder $builder, Request $request)
    {
        if ($request['format'] === 'csv' || $request['format'] === 'xlsx') {
            return Excel::download(new AdvsExport(), 'advs-' . time() . '.' . $request['format']);
        }

        $builder->setOptions([
            'form_view' => 'visiosoft.theme.defaultadmin::form/advs-export',
        ]);

        return $builder->render();
    }

    public function advancedUpdate()
    {
        if ($this->request->has('edit_column') and $this->request->has('edit_entry_id') and $this->request->has('edit_value')) {
            $entry_id = $this->request->get('edit_entry_id');
            $column = $this->request->get('edit_column');
            $value = $this->request->get('edit_value');
            if ($entry = $this->advRepository->find($entry_id)) {
                $entry->setAttribute($column, $value);
                $entry->save();
            }
        }
    }


    public function queryAdvs(AdvRepository $advRepository, AdvModel $advModel)
    {
        $term = request()->term;
        if ($term) {
            $keywords = explode(' ', $term);
            $advs = $advRepository->newQuery()->where(function ($query) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $query->orWhere('slug', 'like', '%' . $keyword . '%')
                        ->orWhere('advs_advs_translations.name', 'like', '%%' . $keyword . '%%');
                }
            })->get()->pluck('name', 'id');

            return $advs;
        }
    }
}
