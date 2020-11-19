<?php namespace Visiosoft\LocationModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Location\LocationCitiesEntryModel;
use Anomaly\Streams\Platform\Model\Location\LocationDistrictsEntryModel;
use Anomaly\Streams\Platform\Model\Location\LocationNeighborhoodsEntryModel;
use Anomaly\Streams\Platform\Model\Location\LocationVillageEntryModel;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\City\CityRepository;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\LocationModule\District\Contract\DistrictRepositoryInterface;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\District\DistrictRepository;
use Visiosoft\LocationModule\Neighborhood\Contract\NeighborhoodRepositoryInterface;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodRepository;
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;
use Visiosoft\LocationModule\Village\VillageRepository;
use Visiosoft\LocationModule\Village\VillageModel;
use Illuminate\Routing\Router;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\LocationModule\Country\CountryRepository;

class LocationModuleServiceProvider extends AddonServiceProvider
{

    /**
     * Additional addon plugins.
     *
     * @type array|null
     */
    protected $plugins = [
        LocationModulePlugin::class
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
        'admin/location/village' => 'Visiosoft\LocationModule\Http\Controller\Admin\VillageController@index',
        'admin/location/village/create' => 'Visiosoft\LocationModule\Http\Controller\Admin\VillageController@create',
        'admin/location/village/edit/{id}' => 'Visiosoft\LocationModule\Http\Controller\Admin\VillageController@edit',
        'admin/location/' => 'Visiosoft\LocationModule\Http\Controller\Admin\CountriesController@index',
        'admin/location/create' => 'Visiosoft\LocationModule\Http\Controller\Admin\CountriesController@create',
        'admin/location/edit/{id}' => 'Visiosoft\LocationModule\Http\Controller\Admin\CountriesController@edit',
        'admin/location/cities' => 'Visiosoft\LocationModule\Http\Controller\Admin\CitiesController@index',
        'admin/location/cities/create' => 'Visiosoft\LocationModule\Http\Controller\Admin\CitiesController@create',
        'admin/location/cities/edit/{id}' => 'Visiosoft\LocationModule\Http\Controller\Admin\CitiesController@edit',
        'admin/location/districts' => 'Visiosoft\LocationModule\Http\Controller\Admin\DistrictsController@index',
        'admin/location/districts/create' => 'Visiosoft\LocationModule\Http\Controller\Admin\DistrictsController@create',
        'admin/location/districts/edit/{id}' => 'Visiosoft\LocationModule\Http\Controller\Admin\DistrictsController@edit',
        'admin/location/neighborhoods' => 'Visiosoft\LocationModule\Http\Controller\Admin\NeighborhoodsController@index',
        'admin/location/neighborhoods/create' => 'Visiosoft\LocationModule\Http\Controller\Admin\NeighborhoodsController@create',
        'admin/location/neighborhoods/edit/{id}' => 'Visiosoft\LocationModule\Http\Controller\Admin\NeighborhoodsController@edit',

        // AjaxController
        'ajax/getCountry' => [
            'as' => 'location::getCountry',
            'uses' => 'Visiosoft\LocationModule\Http\Controller\AjaxController@getCountries'
        ],
        'ajax/getCities' => [
            'as' => 'location::getCities',
            'uses' => 'Visiosoft\LocationModule\Http\Controller\AjaxController@getCities'
        ],
        'ajax/get-city' => 'Visiosoft\LocationModule\Http\Controller\AjaxController@getCity',
        'ajax/getDistricts' => [
            'as' => 'location::getDistricts',
            'uses' => 'Visiosoft\LocationModule\Http\Controller\AjaxController@getDistricts'
        ],
        'ajax/getNeighborhoods' => [
            'as' => 'location::getNeighborhoods',
            'uses' => 'Visiosoft\LocationModule\Http\Controller\AjaxController@getNeighborhoods'
        ],
        'ajax/getVillage' => [
            'as' => 'location::getVillage',
            'uses' => 'Visiosoft\LocationModule\Http\Controller\AjaxController@getVillage'
        ],
        'api/find-location' => [
            'as' => 'visiosoft.module.location::api_find_location',
            'uses' => 'Visiosoft\LocationModule\Http\Controller\AjaxController@findLocation'
        ],
    ];

    /**
     * The addon middleware.
     *
     * @type array|null
     */
    protected $middleware = [
        //Visiosoft\AdvsModule\Http\Middleware\ExampleMiddleware::class
    ];

    /**
     * Addon group middleware.
     *
     * @var array
     */
    protected $groupMiddleware = [
        //'web' => [
        //    Visiosoft\AdvsModule\Http\Middleware\ExampleMiddleware::class,
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
        //Visiosoft\AdvsModule\Event\ExampleEvent::class => [
        //    Visiosoft\AdvsModule\Listener\ExampleListener::class,
        //],
    ];

    /**
     * The addon alias bindings.
     *
     * @type array|null
     */
    protected $aliases = [
        //'Example' => Visiosoft\AdvsModule\Example::class
    ];

    /**
     * The addon class bindings.
     *
     * @type array|null
     */
    protected $bindings = [
        LocationCitiesEntryModel::class => CityModel::class,
        LocationDistrictsEntryModel::class => DistrictModel::class,
        LocationNeighborhoodsEntryModel::class => NeighborhoodModel::class,
        // AdvsCfValuesEntryModel::class => CfValueModel::class,
        // AdvsCustomFieldAdvsEntryModel::class => CustomFieldAdvModel::class,
        // AdvsCustomFieldsEntryModel::class => CustomFieldModel::class,
        LocationVillageEntryModel::class => VillageModel::class,
    ];

    /**
     * The addon singleton bindings.
     *
     * @type array|null
     */
    protected $singletons = [
        CityRepositoryInterface::class => CityRepository::class,
        DistrictRepositoryInterface::class => DistrictRepository::class,
        NeighborhoodRepositoryInterface::class => NeighborhoodRepository::class,
        // CfValueRepositoryInterface::class => CfValueRepository::class,
        // CustomFieldAdvRepositoryInterface::class => CustomFieldAdvRepository::class,
        // CustomFieldRepositoryInterface::class => CustomFieldRepository::class,
        VillageRepositoryInterface::class => VillageRepository::class,
        CountryRepositoryInterface::class => CountryRepository::class,
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
        'streams::form/form' => 'visiosoft.module.advs::form/form',
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
    }

    /**
     * Map additional addon routes.
     *
     * @param Router $router
     */
    // public function map(Router $router)
    // {
    //     // Register dynamic routes here for example.
    //     // Use method injection or commands to bring in services.
    // }
    public function map(Router $router)
    {
    }
}
