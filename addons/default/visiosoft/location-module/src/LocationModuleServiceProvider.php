<?php namespace Visiosoft\LocationModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Location\LocationCitiesEntryModel;
use Anomaly\Streams\Platform\Model\Location\LocationCountriesEntryModel;
use Anomaly\Streams\Platform\Model\Location\LocationDistrictsEntryModel;
use Anomaly\Streams\Platform\Model\Location\LocationNeighborhoodsEntryModel;
use Anomaly\Streams\Platform\Model\Location\LocationVillageEntryModel;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\City\CityRepository;
use Visiosoft\LocationModule\City\Contract\CityRepositoryInterface;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\LocationModule\Country\CountryRepository;
use Visiosoft\LocationModule\City\Events\DeletedCities;
use Visiosoft\LocationModule\Country\Events\DeletedCountry;
use Visiosoft\LocationModule\District\Contract\DistrictRepositoryInterface;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\District\DistrictRepository;
use Visiosoft\LocationModule\District\Events\DeletedDistricts;
use Visiosoft\LocationModule\Neighborhood\Contract\NeighborhoodRepositoryInterface;
use Visiosoft\LocationModule\Neighborhood\Events\DeletedNeighborhoods;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodRepository;
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;
use Visiosoft\LocationModule\Village\VillageRepository;
use Visiosoft\LocationModule\Village\VillageModel;

class LocationModuleServiceProvider extends AddonServiceProvider
{
    protected $plugins = [
        LocationModulePlugin::class
    ];

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

        // API LİST
        'api/location/cities' => [
            'verb' => 'GET',
            'uses' => 'Visiosoft\LocationModule\Http\Controller\ApiController@cities'
        ],
    ];

    protected $bindings = [
        LocationCountriesEntryModel::class => CountryModel::class,
        LocationCitiesEntryModel::class => CityModel::class,
        LocationDistrictsEntryModel::class => DistrictModel::class,
        LocationNeighborhoodsEntryModel::class => NeighborhoodModel::class,
        LocationVillageEntryModel::class => VillageModel::class,
    ];

    protected $singletons = [
        CityRepositoryInterface::class => CityRepository::class,
        DistrictRepositoryInterface::class => DistrictRepository::class,
        NeighborhoodRepositoryInterface::class => NeighborhoodRepository::class,
        VillageRepositoryInterface::class => VillageRepository::class,
        CountryRepositoryInterface::class => CountryRepository::class,
    ];

    protected $listeners = [
        DeletedCountry::class => [
            \Visiosoft\LocationModule\City\Listeners\DeletedCountry::class,
        ],
        DeletedCities::class => [
            \Visiosoft\LocationModule\District\Listeners\DeletedCities::class,
        ],
        DeletedDistricts::class => [
            \Visiosoft\LocationModule\Neighborhood\Listeners\DeletedDistricts::class,
        ],
        DeletedNeighborhoods::class => [
            \Visiosoft\LocationModule\Village\Listeners\DeletedNeighborhoods::class
        ],
    ];
}
