<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;


use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryModel;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\UserModel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Visiosoft\AdvsModule\Adv\Table\Filter\CategoryFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\CityFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\StatusFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\UserFilterQuery;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Event\ChangedStatusAd;
use Visiosoft\AdvsModule\Adv\Form\AdvFormBuilder;
use Visiosoft\AdvsModule\Adv\Table\AdvTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\AlgoliaModule\Search\SearchModel;
use Illuminate\Contracts\Events\Dispatcher;


class AdvsController extends AdminController
{
    private $model;

    public function __construct(AdvModel $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    /**
     * Display an index of existing entries.
     *
     * @param AdvTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AdvTableBuilder $table, \Anomaly\UsersModule\User\UserModel $userModel, CityModel $cityModel, CatsCategoryEntryModel $categoryModel)
    {
        $table->addAsset("theme.css", "visiosoft.module.advs::css/custom.css");
        $table->addAsset('script.js', 'visiosoft.module.advs::js/list.js');

        $table->addButtons([
            'status' => [
                'text' => function (EntryInterface $entry) {
                    if ($entry->status == 'approved') {
                        return "<font class='hidden-xs-down'>" . trans('visiosoft.module.advs::button.decline') . "</font>";
                    } else {
                        return "<font class='hidden-xs-down'>" . trans('visiosoft.module.advs::button.approve') . "</font>";
                    }
                },
                'icon' => function (EntryInterface $entry) {
                    if ($entry->status == 'approved') {
                        return "fa fa-eye-slash";
                    } else {
                        return "fa fa-eye";
                    }
                },
                'href' => function (EntryInterface $entry) {
                    if ($entry->status == 'approved') {
                        return "/admin/class/actions/{entry.id}/declined";
                    } else {
                        return "/admin/class/actions/{entry.id}/approved";
                    }
                },
                'type' => function (EntryInterface $entry) {
                    if ($entry->status == 'approved') {
                        return "danger";
                    } else {
                        return "success";
                    }
                },
            ],
            'edit' => [
                'href' => '/advs/edit_advs/{entry.id}',
                'text' => "<font class='hidden-xs-down'>" . trans('streams::button.edit') . "</font>",
            ],
            'change_owner' => [
                'data-toggle' => 'modal',
                'data-target' => '#modal',
                'text' => "<font class='hidden-xs-down'>" . trans('visiosoft.module.advs::button.change_owner') . "</font>",
                'icon' => 'fa fa-users',
                'href' => 'admin/advs-users/choose/{entry.id}',
            ]
        ]);

        if ($this->model->is_enabled('recommendedads')) {
            $table->addButton('add_recommended', [
                'type' => 'default',
                'icon' => 'fa fa-gg',
                'text' => 'Add Recommended',
                'href' => '/admin/recommendedads/create/{entry.id}',
            ]);
        }

        $table->setColumns([
            'cover_photo' => [
                'value' => function (EntryInterface $entry) {
                    return "<img width='80px' src='" . $this->model->AddAdsDefaultCoverImage($entry)->cover_photo . "' >";
                },
            ],
            'entry.id',
            'name' => [
                'class' => 'advs-name',
                'value' => function (EntryInterface $entry) {
                    return "<a href='" . $this->model->getAdvDetailLinkByModel($entry, 'list') . "' > " . $entry->name . "</a > ";
                },
            ],
            'price' => [
                'class' => 'advs-price',
            ],
            'currency' => [
                'class' => 'advs-currency',
            ],
            'country' => [
                'class' => 'advs-country',
            ],
            'created_by' => [
                'value' => function (EntryInterface $entry, UserModel $userModel) {
                    $user = $userModel->find($entry->created_by_id);
                    if (!is_null($user))
                        return $user->first_name . " " . $user->last_name;
                }
            ],
            'category' => [
                'value' => function (EntryInterface $entry, CategoryModel $categoryModel) {
                    $category = $categoryModel->getCat($entry->cat1);
                    if (!is_null($category))
                        return $category->name;
                }
            ],
            'finish_at',
        ]);


        $cities = $cityModel->all()->pluck('name', 'id')->all();
        $users = $userModel->all()->pluck('email', 'id')->all();
        $phone = $userModel->all()->pluck('gsm_phone', 'id')->all();
        $categories = $categoryModel::query()->where('parent_category_id', null)
            ->leftJoin('cats_category_translations', 'cats_category.id', '=', 'cats_category_translations.entry_id')
            ->where('locale', config('app.locale'))
            ->select('cats_category.*', 'cats_category_translations.name')
            ->pluck('t1.name', 'id')->all();
        $table->setFilters(array_merge($table->getFilters(),
                [
                    'City' => [
                        'exact' => true,
                        'filter' => 'select',
                        'query' => CityFilterQuery::class,
                        'options' => $cities,
                    ],
                    'Category' => [
                        'exact' => true,
                        'filter' => 'select',
                        'query' => CategoryFilterQuery::class,
                        'options' => $categories,
                    ],
                    'User' => [
                        'exact' => true,
                        'filter' => 'select',
                        'query' => UserFilterQuery::class,
                        'options' => $users,
                    ],
                    'phone' => [
                        'exact' => true,
                        'filter' => 'select',
                        'query' => UserFilterQuery::class,
                        'options' => $phone,
                    ],
                    'status' => [
                        'filter' => 'select',
                        'query' => StatusFilterQuery::class,
                        'options' => [
                            'approved' => 'visiosoft.module.advs::field.status.option.approved',
                            'expired' => 'visiosoft.module.advs::field.status.option.expired',
                            'unpublished' => 'visiosoft.module.advs::field.status.option.unpublished',
                            'pending_admin' => 'visiosoft.module.advs::field.status.option.pending_admin',
                            'pending_user' => 'visiosoft.module.advs::field.status.option.pending_user',
                        ],
                    ]
                ])
        );

        return $table->render();
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

    /**
     * Create a new entry.
     *
     * @param AdvFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(AdvFormBuilder $form)
    {
        // $this->dispatch(new AddEntryFormFromRequest($form));
        // $this->dispatch(new AddAdvFormFromRequest($form));
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param AdvFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(AdvFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    public function actions($id, $type, SettingRepositoryInterface $settings, AdvModel $advModel)
    {

        $ad = $advModel->where('advs_advs.id', '=', $id)->first();
        $ad->status = $type;

        $default_adv_publish = $settings->value('visiosoft.module.advs::default_published_time');
        $ad->finish_at = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $default_adv_publish . ' day'));
        $ad->publish_at = date('Y-m-d H:i:s');

        //algolia Search Module
        $isActiveAlgolia = $advModel->is_enabled('algolia');
        if ($isActiveAlgolia) {
            $algolia = new SearchModel();
            $algolia->updateStatus($id, $type, $settings);
        }
        $ad->update();
        event(new ChangedStatusAd($ad));//Create Notify
        return back();
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
}
