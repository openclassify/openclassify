<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;


use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryModel;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;
use Anomaly\Streams\Platform\Model\Users\UsersUsersEntryModel;
use Visiosoft\AdvsModule\Adv\Table\Filter\CategoryFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\CityFilterQuery;
use Visiosoft\AdvsModule\Adv\Table\Filter\UserFilterQuery;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Event\ChangeStatusAd;
use Visiosoft\AdvsModule\Adv\Form\AdvFormBuilder;
use Visiosoft\AdvsModule\Adv\Table\AdvTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\AlgoliaModule\Search\SearchModel;
use Illuminate\Contracts\Events\Dispatcher;


class AdvsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param AdvTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(AdvTableBuilder $table, \Anomaly\UsersModule\User\UserModel $userModel, CityModel $cityModel, CatsCategoryEntryModel $categoryModel)
    {
        $table->addAsset("theme.css", "visiosoft.module.advs::css/custom.css");
        $table->addAsset('script.js', 'visiosoft.module.advs::js/admin-list.js');

        $table->addButtons([
            'status' => [
                'text' => function (EntryInterface $entry) {
                    if ($entry->status == 'approved') {
                        return "visiosoft.module.advs::button.decline";
                    } else {
                        return "visiosoft.module.advs::button.approve";
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
            ]
        ]);

        $table->setColumns([
            'name' => [
                'class' => 'advs-name',
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
                'value' => function (EntryInterface $entry) {
                    $user = UsersUsersEntryModel::query()->where('users_users.id', $entry->created_by_id)->first();
                    return $user->first_name . " " . $user->last_name;
                }
            ],
            'category' => [
                'value' => function (EntryInterface $entry) {
                    $category = CategoryModel::query()->where('cats_category.id', $entry->cat1)->first();
                    return $category->name;
                }
            ],
        ]);


        $cities = $cityModel->all()->pluck('name', 'id')->all();
        $users = $userModel->all()->pluck('email', 'id')->all();
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
                    ]
                ])
        );

        return $table->render();
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

    public function actions($id, $type, SettingRepositoryInterface $settings, Dispatcher $events)
    {

        $adv = AdvsAdvsEntryModel::query()->where('advs_advs.id', '=', $id)->first();
        $adv->status = $type;

        $default_adv_publish = $settings->value('visiosoft.module.advs::default_published_time');
        $adv->finish_at = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $default_adv_publish . ' day'));

        //algolia Search Module
        $isActiveAlgolia = new AdvModel();
        $isActiveAlgolia = $isActiveAlgolia->is_enabled('algolia');
        if ($isActiveAlgolia) {
            $algolia = new SearchModel();
            $algolia->updateStatus($id, $type, $settings);
        }
        $adv->update();
        $events->dispatch(new ChangeStatusAd($id, $settings));//Create Notify
        return back();
    }
}
