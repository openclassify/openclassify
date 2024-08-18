<?php namespace Visiosoft\CustomfieldsModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Visiosoft\CustomfieldsModule\Parent\Contract\ParentRepositoryInterface;
use Visiosoft\CustomfieldsModule\Parent\ParentRepository;
use Anomaly\Streams\Platform\Model\Customfields\CustomfieldsParentEntryModel;
use Visiosoft\CustomfieldsModule\Parent\ParentModel;
use Visiosoft\CustomfieldsModule\Cfvalue\Contract\CfvalueRepositoryInterface;
use Visiosoft\CustomfieldsModule\Cfvalue\CfvalueRepository;
use Anomaly\Streams\Platform\Model\Customfields\CustomfieldsCfvalueEntryModel;
use Visiosoft\CustomfieldsModule\Cfvalue\CfvalueModel;
use Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldRepositoryInterface;
use Visiosoft\CustomfieldsModule\CustomField\CustomFieldRepository;
use Anomaly\Streams\Platform\Model\Customfields\CustomfieldsCustomFieldsEntryModel;
use Visiosoft\CustomfieldsModule\CustomField\CustomFieldModel;

class CustomfieldsModuleServiceProvider extends AddonServiceProvider
{
    protected $plugins = [
        CustomfieldsModulePlugin::class
    ];

    protected $routes = [
        'admin/customfields/cfvalue' => 'Visiosoft\CustomfieldsModule\Http\Controller\Admin\CfvalueController@index',
        'admin/customfields/cfvalue/create' => 'Visiosoft\CustomfieldsModule\Http\Controller\Admin\CfvalueController@create',
        'admin/customfields/cfvalue/edit/{id}' => 'Visiosoft\CustomfieldsModule\Http\Controller\Admin\CfvalueController@edit',
        'admin/customfields' => [
            'as' => 'visiosoft.module.customfields::admin_customfields_list',
            'uses' => 'Visiosoft\CustomfieldsModule\Http\Controller\Admin\CustomFieldsController@index',
        ],
        'admin/customfields/create' => 'Visiosoft\CustomfieldsModule\Http\Controller\Admin\CustomFieldsController@create',
        'admin/customfields/edit/{id}' => 'Visiosoft\CustomfieldsModule\Http\Controller\Admin\CustomFieldsController@edit',
        'admin/get-sub-cats/{id}' => 'Visiosoft\CustomfieldsModule\Http\Controller\Admin\CustomFieldsController@getSubCats',


        //Ajax Controller
        'ajax/customfields/search-category' => [
            'as' => 'visiosoft.module.customfields::ajax.search_category',
            'uses' => 'Visiosoft\CustomfieldsModule\Http\Controller\AjaxController@searchCategory',
        ],

	    'ajax/get-cf-value/{id}' => 'Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController@getCfValue',

        'ajax/get-cf-inputs' => 'Visiosoft\CustomfieldsModule\Http\Controller\AjaxController@getCustomFieldsCreateViewByAdv',
        'ajax/get-cfval-bycfid/{id}' => 'Visiosoft\CustomfieldsModule\Http\Controller\AjaxController@getCustomFieldsValueByCfId'
    ];

    protected $bindings = [
        CustomfieldsParentEntryModel::class => ParentModel::class,
        CustomfieldsCfvalueEntryModel::class => CfvalueModel::class,
        CustomfieldsCustomFieldsEntryModel::class => CustomFieldModel::class,
    ];

    protected $singletons = [
        ParentRepositoryInterface::class => ParentRepository::class,
        CfvalueRepositoryInterface::class => CfvalueRepository::class,
        CustomFieldRepositoryInterface::class => CustomFieldRepository::class,
    ];
}
