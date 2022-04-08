<?php namespace Anomaly\Streams\Platform\Asset;

use Illuminate\Contracts\Config\Repository;

/**
 * Class AssetFilters
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssetFilters
{

    /**
     * The asset filters.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * Create a new AssetFilters instance.
     *
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->filters = $config->get('streams::assets.filters', []);
    }

    /**
     * Transform the filters.
     *
     * @param array $filters
     * @return array
     */
    public function transform(array $filters)
    {
        foreach ($filters as $k => &$filter) {

            /**
             * Transform filters.
             */
            if ($class = array_get($this->filters, $filter)) {
                $filter = new $class;
            }
        }

        return $filters;
    }

    /**
     * Add a filter.
     *
     * @param $filter
     * @param $class
     * @return $this
     */
    public function addFilter($filter, $class)
    {
        $this->filters[$filter] = $class;

        return $this;
    }

    /**
     * Get the filters.
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->filters;
    }
}
