<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryTranslationsModel;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Adv\Table\Filter\CategoryFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\CityFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\StatusFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\UserFilterQuery;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Event\ChangedStatusAd;
use Visiosoft\AdvsModule\Adv\Table\AdvTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\AdvsModule\Option\Contract\OptionRepositoryInterface;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\AlgoliaModule\Search\SearchModel;

class AdvsController extends AdminController
{

    private $advRepository;
    private $advsEntryTranslationsModel;
    private $optionRepository;
    private $userRepository;

    public function __construct(
        AdvRepositoryInterface $advRepository,
        AdvsAdvsEntryTranslationsModel $advsEntryTranslationsModel,
        OptionRepositoryInterface $optionRepository,
        UserRepositoryInterface $userRepository
    )
    {
        parent::__construct();
        $this->advRepository = $advRepository;
        $this->advsEntryTranslationsModel = $advsEntryTranslationsModel;
        $this->optionRepository = $optionRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display an index of existing entries.
     *
     * @param AdvTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AdvTableBuilder $table, CityModel $cityModel, CatsCategoryEntryModel $categoryModel)
    {
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

            'settings' => [
                'text'     => false,
                'href'     => false,
                'dropdown' => [
                    'change_owner'    => [
                        'data-toggle' => 'modal',
                        'data-target' => '#modal',
                        'text'        => trans('visiosoft.module.advs::button.change_owner'),
                        'href'        => 'admin/advs-users/choose/{entry.id}',
                    ],
                    'replicate' => [
                        'text' => 'Replicate',
                    ],
                ],
            ],
        ]);

        $table->setColumns([
            'cover_photo' => [
                'value' => function (EntryInterface $entry) {
                    $coverImageUrl = $this->advRepository->getModel()->AddAdsDefaultCoverImage($entry)->cover_photo;
                    return "<img width='80px' src='{$coverImageUrl}' >";
                },
            ],
            'entry.id',
            'name' => [
                'class' => 'advs-name',
                'sort_column' => 'slug',
                'value' => function (EntryInterface $entry) {
                    if ($entry->name) {
                        $adLink = $this->advRepository->getModel()->getAdvDetailLinkByModel($entry, 'list');
                        return "<a href='$adLink' >{$entry->name}</a >";
                    } else {
                        return "<span class='text-danger'>" . trans("visiosoft.module.advs::view.unfinished") . "</span>";
                    }
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
                'value' => 'entry.created_by.name'
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
        $users = $this->userRepository->newQuery()
            ->select(DB::raw("CONCAT_WS('', first_name, ' ', last_name, ' (', gsm_phone, ' || ', email, ')') AS display_name"), 'id')
            ->pluck('display_name', 'id')
            ->toArray();
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
            $this->advRepository->getModel()->newQuery()->find($advId)->update(['created_by_id' => $request->user_id]);
            $this->messages->success(trans('module::message.owner_updated_successfully'));
            return redirect()->back();
        }
    }

    public function actions($id, $type)
    {
        $ad = $this->advRepository->find($id);
        $ad->status = $type;

        $default_adv_publish = setting_value('visiosoft.module.advs::default_published_time');
        $ad->finish_at = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $default_adv_publish . ' day'));
        $ad->publish_at = date('Y-m-d H:i:s');

        //algolia Search Module
        $isActiveAlgolia = $this->advRepository->getModel()->is_enabled('algolia');
        if ($isActiveAlgolia) {
            $algolia = new SearchModel();
            $algolia->updateStatus($id, $type);
        }
        $ad->update();
        event(new ChangedStatusAd($ad)); //Create Notify
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
                    $adv['advs_desc']
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

                // Replicate ad custom fields
                $advCustomFields = $this->model->is_enabled('customfields');
                if ($advCustomFields) {
                    $advCustomFields = app('Visiosoft\CustomfieldsModule\CustomFieldAdv\Contract\CustomFieldAdvRepositoryInterface')
                        ->newQuery()->where('parent_adv_id', $advID)->get();
                    foreach ($advCustomFields as $advCustomField) {
                        $newaAdvCustomField = $advCustomField->replicate();
                        $newaAdvCustomField->parent_adv_id = $newAdv->id;
                        $newaAdvCustomField->save();
                    }
                }

                $this->messages->success(trans('visiosoft.module.advs::message.replicated_success'));
            }

            return redirect('admin/advs');
        } catch (\Exception $e) {
            $this->messages->error($e->getMessage());
            return redirect('admin/advs');
        }
    }

    public function assetsClear(Filesystem $files, Application $application)
    {
        $files->deleteDirectory($directory = $application->getAssetsPath('assets'), true);
        echo view('visiosoft.module.advs::admin/clear-assets')->render();
    }
}
