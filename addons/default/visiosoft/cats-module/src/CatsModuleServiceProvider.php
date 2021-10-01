<?php namespace Visiosoft\CatsModule;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Visiosoft\AdvsModule\Adv\Event\ChangedStatusAd;
use Visiosoft\AdvsModule\Adv\Event\CreatedAd;
use Visiosoft\AdvsModule\Adv\Event\DeletedAd;
use Visiosoft\AdvsModule\Adv\Event\EditedAdCategory;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\CategoryRepository;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\CatsModule\Category\Listener\CalculatedTotalForChangedAdStatus;
use Visiosoft\CatsModule\Category\Listener\CalculatedTotalForDeletedAd;
use Visiosoft\CatsModule\Category\Listener\CalculatedTotalForEditedAdCategory;
use Visiosoft\CatsModule\Category\Listener\CalculatedTotalForNewAd;

class CatsModuleServiceProvider extends AddonServiceProvider
{
    protected $plugins = [
        CatsModulePlugin::class,
    ];

    protected $routes = [
        'admin/cats/clean_subcats' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@cleanSubCategories',
        'admin/cats/adcountcalc' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@adCountCalc',
        'admin/cats/catlevelcalc' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@catLevelCalc',

        'admin/cats' => [
            'as' => 'visiosoft.module.cats::admin_cats',
            'uses' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@index'
        ],
        'admin/cats/create' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@create',
        'admin/cats/edit/{id}' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@edit',
        'admin/cats/category/delete/{id}' => [
            'as' => 'visiosoft.module.cats::admin.delete_category',
            'uses' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@delete',
        ],
        'admin/cats/import' => [
            'as' => 'visiosoft.module.cats::import',
            'uses' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@import',
        ],
        'admin/cats/export' => [
            'as' => 'visiosoft.module.cats::export',
            'uses' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@export',
        ],
        'admin/api/cats/all' => [
            'as' => 'visiosoft.module.cats::admin.api.cats.all',
            'uses' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@all',
        ],

        // Admin ReportController
        'admin/api/cats/report/category' => 'Visiosoft\CatsModule\Http\Controller\Admin\ReportController@category',

        // Sitemap
        'sitemap.xml' => 'Visiosoft\CatsModule\Http\Controller\SitemapController@index',
        'sitemap.xml/categories' => 'Visiosoft\CatsModule\Http\Controller\SitemapController@categories',
    ];

    protected $listeners = [
        CreatedAd::class => [
            CalculatedTotalForNewAd::class,
        ],
        EditedAdCategory::class => [
            CalculatedTotalForEditedAdCategory::class,
        ],
        ChangedStatusAd::class => [
            CalculatedTotalForChangedAdStatus::class,
        ],
        DeletedAd::class => [
            CalculatedTotalForDeletedAd::class,
        ],
    ];

    protected $bindings = [
        CatsCategoryEntryModel::class => CategoryModel::class,
    ];

    protected $singletons = [
        CategoryRepositoryInterface::class => CategoryRepository::class,
    ];

    public function boot(AddonCollection $addonCollection)
    {
        $settings_url = [
            'import' => [
                'title' => 'visiosoft.module.advs::button.import',
                'href' => route('visiosoft.module.cats::import'),
                'page' => 'visiosoft.module.cats'
            ],
            'export' => [
                'title' => 'visiosoft.module.advs::button.export',
                'href' => route('visiosoft.module.cats::export'),
                'page' => 'visiosoft.module.cats'
            ],
        ];

        foreach ($settings_url as $key => $value) {
            $addonCollection->get($value['page'])->addSection($key, $value);
        }
    }

    public function getOverrides()
    {
        $request = app('Illuminate\Http\Request');
        $view = $request->get('view');

        if ($request->segment(2) === $this->addon->getSlug() && $view !== 'table' and $request->path() == "admin/cats") {
            $sections = [
                'category' => [
                    'buttons' => [
                        'new_category' => [
                            'href' => '/admin/cats/create?parent=' . $request->cat
                        ],
                    ],
                ]
            ];
            $this->addon->setSections($sections);
        }
        return parent::getOverrides();
    }
}
