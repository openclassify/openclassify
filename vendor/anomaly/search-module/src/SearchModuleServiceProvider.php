<?php namespace Anomaly\SearchModule;

use Anomaly\SearchModule\Item\Contract\ItemRepositoryInterface;
use Anomaly\SearchModule\Item\ItemModel;
use Anomaly\SearchModule\Item\ItemRepository;
use Anomaly\SearchModule\Search\SearchEngine;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Search\SearchItemsEntryModel;
use Laravel\Scout\EngineManager;

/**
 * Class SearchModuleServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SearchModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        SearchModulePlugin::class,
    ];

    /**
     * The addon class bindings.
     *
     * @type array|null
     */
    protected $bindings = [
        SearchItemsEntryModel::class => ItemModel::class,
    ];

    /**
     * The addon singleton bindings.
     *
     * @type array|null
     */
    protected $singletons = [
        ItemRepositoryInterface::class => ItemRepository::class,
    ];

    /**
     * Boot the addon.
     */
    public function boot()
    {
        resolve(EngineManager::class)->extend(
            'search',
            function () {
                return new SearchEngine(app(ItemRepositoryInterface::class));
            }
        );
    }

}
