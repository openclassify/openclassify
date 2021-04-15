<?php namespace Visiosoft\CatsModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Visiosoft\AdvsModule\Adv\Event\ChangedStatusAd;
use Visiosoft\AdvsModule\Adv\Event\CreatedAd;
use Visiosoft\AdvsModule\Adv\Event\DeletedAd;
use Visiosoft\AdvsModule\Adv\Event\EditedAdCategory;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\CategoryRepository;
use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;
use Visiosoft\CatsModule\Category\CategoryModel;
use Illuminate\Routing\Router;
use Visiosoft\CatsModule\Category\Listener\CalculatedTotalForChangedAdStatus;
use Visiosoft\CatsModule\Category\Listener\CalculatedTotalForDeletedAd;
use Visiosoft\CatsModule\Category\Listener\CalculatedTotalForEditedAdCategory;
use Visiosoft\CatsModule\Category\Listener\CalculatedTotalForNewAd;
use Visiosoft\CatsModule\Category\Table\Handler\Delete;

class CatsModuleServiceProvider extends AddonServiceProvider
{

    /**
     * Additional addon plugins.
     *
     * @type array|null
     */
    protected $plugins = [
        CatsModulePlugin::class,
    ];

    /**
     * The addon Artisan commands.
     *
     * @type array|null
     */
    protected $commands = [];

    /**
     * The addon's scheduled commands.
     *
     * @type array|null
     */
    protected $schedules = [];

    /**
     * The addon API routes.
     *
     * @type array|null
     */
    protected $api = [];

    /**
     * The addon routes.
     *
     * @type array|null
     */
    protected $routes = [
        'admin/cats/clean_subcats' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@cleanSubCategories',
        'admin/cats/adcountcalc' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@adCountCalc',
        'admin/cats/catlevelcalc' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@catLevelCalc',

        'admin/cats' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@index',
        'admin/cats/create' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@create',
        'admin/cats/edit/{id}' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@edit',
        'admin/cats/category/delete/{id}' => [
            'as' => 'visiosoft.module.cats::admin.delete_category',
            'uses' => 'Visiosoft\CatsModule\Http\Controller\Admin\CategoryController@delete',
        ],

        // Sitemap
        'sitemap.xml' => 'Visiosoft\CatsModule\Http\Controller\SitemapController@index',
        'sitemap.xml/categories' => 'Visiosoft\CatsModule\Http\Controller\SitemapController@categories',
    ];

    /**
     * The addon middleware.
     *
     * @type array|null
     */
    protected $middleware = [
        //Visiosoft\CatsModule\Http\Middleware\ExampleMiddleware::class
    ];

    /**
     * Addon group middleware.
     *
     * @var array
     */
    protected $groupMiddleware = [
        //'web' => [
        //    Visiosoft\CatsModule\Http\Middleware\ExampleMiddleware::class,
        //],
    ];

    /**
     * Addon route middleware.
     *
     * @type array|null
     */
    protected $routeMiddleware = [];

    /**
     * The addon event listeners.
     *
     * @type array|null
     */
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

    /**
     * The addon alias bindings.
     *
     * @type array|null
     */
    protected $aliases = [
        //'Example' => Visiosoft\CatsModule\Example::class
    ];

    /**
     * The addon class bindings.
     *
     * @type array|null
     */
    protected $bindings = [
        CatsCategoryEntryModel::class => CategoryModel::class,
    ];

    /**
     * The addon singleton bindings.
     *
     * @type array|null
     */
    protected $singletons = [
        CategoryRepositoryInterface::class => CategoryRepository::class,
    ];

    /**
     * Additional service providers.
     *
     * @type array|null
     */
    protected $providers = [
        //\ExamplePackage\Provider\ExampleProvider::class
    ];

    /**
     * The addon view overrides.
     *
     * @type array|null
     */
    protected $overrides = [
        //'streams::errors/404' => 'module::errors/404',
        //'streams::errors/500' => 'module::errors/500',
    ];

    /**
     * The addon mobile-only view overrides.
     *
     * @type array|null
     */
    protected $mobile = [
        //'streams::errors/404' => 'module::mobile/errors/404',
        //'streams::errors/500' => 'module::mobile/errors/500',
    ];

    /**
     * Register the addon.
     */
    public function register()
    {
        // Run extra pre-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Boot the addon.
     */
    public function boot()
    {
        // Run extra post-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Map additional addon routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        // Register dynamic routes here for example.
        // Use method injection or commands to bring in services.
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
