<?php namespace Anomaly\NavigationModule;

use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Anomaly\NavigationModule\Link\LinkModel;
use Anomaly\NavigationModule\Link\LinkRepository;
use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\NavigationModule\Menu\MenuModel;
use Anomaly\NavigationModule\Menu\MenuRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Navigation\NavigationLinksEntryModel;
use Anomaly\Streams\Platform\Model\Navigation\NavigationMenusEntryModel;

/**
 * Class NavigationModuleServiceProvider
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class NavigationModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        NavigationModulePlugin::class,
    ];

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        NavigationLinksEntryModel::class => LinkModel::class,
        NavigationMenusEntryModel::class => MenuModel::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        LinkRepositoryInterface::class => LinkRepository::class,
        MenuRepositoryInterface::class => MenuRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/navigation'                          => 'Anomaly\NavigationModule\Http\Controller\Admin\MenusController@index',
        'admin/navigation/choose'                   => 'Anomaly\NavigationModule\Http\Controller\Admin\MenusController@choose',
        'admin/navigation/create'                   => 'Anomaly\NavigationModule\Http\Controller\Admin\MenusController@create',
        'admin/navigation/edit/{id}'                => 'Anomaly\NavigationModule\Http\Controller\Admin\MenusController@edit',
        'admin/navigation/links/{menu?}'            => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@index',
        'admin/navigation/links/{menu}/create'      => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@create',
        'admin/navigation/links/{menu}/edit/{id}'   => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@edit',
        'admin/navigation/links/{menu}/view/{id}'   => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@view',
        'admin/navigation/links/{menu}/change/{id}' => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@change',
        'admin/navigation/links/delete/{id}'        => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@delete',
        'admin/navigation/links/choose/{menu}'      => 'Anomaly\NavigationModule\Http\Controller\Admin\LinksController@choose',
    ];

}
